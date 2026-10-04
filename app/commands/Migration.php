<?php
/**
 * Command: Migration
 *
 * Auto-discovered by the LavaLust CLI.
 * No registration needed — just drop this file in app/commands/.
 */
class MigrationCommand
{
    /**
     * The CLI command name.
     * Usage: php lava migration
     */
    public static $command = 'migration';

    /** Short description shown in php lava help */
    public static $description = 'Run database migrations';

    /**
     * Argument/flag descriptions shown in help.
     *
     * Example:
     *   public static $arguments = [
     *       'name'        => 'A positional argument',
     *       '[--flag=<v>]' => 'An optional flag',
     *   ];
     */
    public static $arguments = [
        'action' => 'run, create-migration, rollback, rollback-all, refresh, or status',
        '[--name=<migration_class>]' => 'Migration name for create-migration',
    ];

    /**
     * Command entry point.
     *
     * @param string|null $input   First positional argument (php lava migration <input>)
     * @param array       $flags   Associative array of --flag=value pairs
     */
    public function handle($input = null, array $flags = [])
    {
        $actions = [
            'run' => 'migrate',
            'create-migration' => 'create_migration',
            'rollback' => 'rollback',
            'rollback-all' => 'rollback_all',
            'refresh' => 'refresh',
            'status' => 'status',
        ];

        if (!isset($actions[$input])) {
            fwrite(STDERR, "Usage: php lava migration <run|create-migration|rollback|rollback-all|refresh|status> [--name=<migration_class>]" . PHP_EOL);
            exit(1);
        }

        $controller = $this->boot_lavalust();
        $controller->call->library('migration');

        if ($input === 'create-migration') {
            $migration_class = $flags['name'] ?? $flags['migration_class'] ?? null;
            if (!$migration_class) {
                fwrite(STDERR, "The create-migration action requires --name=<migration_class>." . PHP_EOL);
                exit(1);
            }

            $controller->migration->create_migration($migration_class);
            return;
        }

        $method = $actions[$input];
        $controller->migration->{$method}();
    }

    private function boot_lavalust()
    {
        $root = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR;

        defined('PREVENT_DIRECT_ACCESS') OR define('PREVENT_DIRECT_ACCESS', TRUE);
        defined('ROOT_DIR') OR define('ROOT_DIR', $root);
        defined('SYSTEM_DIR') OR define('SYSTEM_DIR', ROOT_DIR . 'scheme' . DIRECTORY_SEPARATOR);
        defined('APP_DIR') OR define('APP_DIR', ROOT_DIR . 'app' . DIRECTORY_SEPARATOR);
        defined('PUBLIC_DIR') OR define('PUBLIC_DIR', ROOT_DIR . 'public' . DIRECTORY_SEPARATOR);
        defined('RUNTIME_DIR') OR define('RUNTIME_DIR', ROOT_DIR . 'runtime' . DIRECTORY_SEPARATOR);

        require_once SYSTEM_DIR . 'kernel/Registry.php';
        require_once SYSTEM_DIR . 'kernel/Routine.php';

        $env_file = ROOT_DIR . '.env';
        if (is_file($env_file)) {
            foreach (file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                $line = trim($line);
                if ($line === '' || $line[0] === '#' || !str_contains($line, '=')) {
                    continue;
                }

                [$key, $value] = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);

                if (!preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $key)) {
                    continue;
                }

                if (strlen($value) >= 2 && in_array($value[0], ['"', "'"], true) && $value[-1] === $value[0]) {
                    $value = substr($value, 1, -1);
                }

                putenv("{$key}={$value}");
                $_ENV[$key] = $_SERVER[$key] = $value;
            }
        }

        defined('BASE_URL') OR define('BASE_URL', config_item('base_url'));
        load_class('config', 'kernel');
        require_once SYSTEM_DIR . 'kernel/Controller.php';

        return new Controller();
    }
}

if (!function_exists('lava_instance')) {
    function lava_instance()
    {
        return Controller::instance();
    }
}