# NEO-SHOGUN // DIGITAL VANGUARD
A high-performance, cyberpunk-themed eCommerce suite built with PHP and MySQL.

## Features
- **Dynamic Catalog**: Full database integration for artifacts and categories.
- **Identity Hub**: Secure user authentication and profile management.
- **Vault Protocol**: Session-based shopping cart and acquisition (checkout) system.
- **Intelligence Reports**: Product reviews and affinity rating system.
- **Neural Comms**: Real-time notification system.
- **Admin Center**: Full command center for managing products, orders, and users.
- **Indian Localization**: Optimized for ₹ (INR), Indian addresses, and GST compliance.

## Installation Protocol

### 1. Database Setup
- Create a MySQL database named `neo_shogun` (Local) or use your hosting provided DB name.
- Import the SQL schema located in `database/neo_shogun.sql`.

### 2. Configuration
- Open `config/db.php`.
- The system automatically detects if you are on `localhost` or a live server.
- Update the credentials for your live server in the `else` block of the detection logic.

### 3. Deployment
- Upload all files to your server's `htdocs` or `public_html` folder.
- **IMPORTANT**: Delete any existing `index.html` file on the server to allow `index.php` to take precedence.

## Security Note
- Ensure `config/db.php` is kept secure.
- For production environments, it is recommended to move credentials to environment variables.

---
© 2024 NEO-SHOGUN INDUSTRIES. ALL RIGHTS RESERVED.
