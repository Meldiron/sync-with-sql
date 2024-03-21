# ⚡ PHP Sync with SQL

Sync Appwrite databases to SQL database. Collections will become tables and documents will become rows.

If a table is missing, it will be created. If a table is present, schema will not be updated. Manually delete a table to recreate it.

If a row is missing, it will be inserted. If a row is present, it will be updated based on ID.

Limits:

- Max 1k databases
- Max 1k collections per database
- Max 1M documents per collection

## 🧰 Usage

### POST /

Triggers synchronization from Appwrite database to SQL database.

**Response**

Sample `204` Response: No content.

## ⚙️ Configuration

| Setting           | Value              |
| ----------------- | ------------------ |
| Runtime           | PHP (8.0)          |
| Entrypoint        | `src/index.php`    |
| Build Commands    | `composer install` |
| Permissions       | `any`              |
| Timeout (Seconds) | 15                 |

## 🔒 Environment Variables

### APPWRITE_API_KEY

API Key to talk to Appwrite backend APIs.

| Question      | Answer                                                                                             |
| ------------- | -------------------------------------------------------------------------------------------------- |
| Required      | Yes                                                                                                |
| Sample Value  | `d1efb...aec35`                                                                                    |
| Documentation | [Appwrite: Getting Started for Server](https://appwrite.io/docs/advanced/platform/api-keys) |

### APPWRITE_ENDPOINT

The URL endpoint of the Appwrite server. If not provided, it defaults to the Appwrite Cloud server: `https://cloud.appwrite.io/v1`.

| Question     | Answer                         |
| ------------ | ------------------------------ |
| Required     | No                             |
| Sample Value | `https://cloud.appwrite.io/v1` |

### PDO_CONNECTION_STRING

The connection string to the SQL database using PHP DO.

| Question     | Answer                  |
| ------------ | ----------------------- |
| Required     | Yes                     |
| Sample Value | `mysql:host=localhost;port=3306;dbname=appwrite;user=user;password=password` |
