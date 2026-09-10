# LavaLust Products Deployment

## Aiven MySQL

Create an Aiven MySQL service and database, then run this SQL in the Aiven query editor:

```sql
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

Use the Aiven connection values for `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, and `DB_PASS`. Do not commit `.env`; it is ignored by Git. For local development, copy `.env.example` to `.env` and fill in the values.

## Render

This repository includes `render.yaml` and deploys with the included Dockerfile. Create a new Render Blueprint from the GitHub repository, or create a Docker web service manually.

Set these variables in Render:

```text
APP_ENV=production
DB_DRIVER=mysql
DB_HOST=<Aiven host>
DB_PORT=<Aiven port>
DB_NAME=<Aiven database name>
DB_USER=<Aiven user>
DB_PASS=<Aiven password>
DB_CHARSET=utf8mb4
```

The Aiven service must allow connections from Render. For production, configure Aiven's trusted sources according to its current networking controls and use TLS settings required by your Aiven plan.

## GitHub deployment commands

```bash
git init
git add .
git commit -m "Add LavaLust product CRUD"
git branch -M main
git remote add origin https://github.com/<your-user>/<your-repository>.git
git push -u origin main
```

After pushing, connect the repository to Render and choose **New Blueprint Instance**. Render reads `render.yaml`, prompts for the `sync: false` values, builds the Docker image, and deploys the service.

Open `/products` after deployment. The application uses prepared statements through LavaLust's PDO database layer, validates all submitted fields on the server, and escapes rendered product values.