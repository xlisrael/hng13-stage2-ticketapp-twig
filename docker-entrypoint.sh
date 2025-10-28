#!/bin/sh
set -e

# If Render (or environment) provides PORT, update Apache to listen on it.
if [ -n "$PORT" ]; then
  # Update ports.conf Listen directive
  sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf || true
  # Update the virtual host config port
  sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g" /etc/apache2/sites-available/000-default.conf || true
fi

# Ensure DocumentRoot points to public
sed -i 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#' /etc/apache2/sites-available/000-default.conf || true

# Ensure Directory directive exists for /var/www/html/public
if ! grep -q "/var/www/html/public" /etc/apache2/sites-available/000-default.conf; then
  cat >> /etc/apache2/sites-available/000-default.conf <<'EOT'
<Directory /var/www/html/public>
    AllowOverride All
    Require all granted
</Directory>
EOT
fi

# Create cache directories and set permissions
mkdir -p /var/www/html/cache/twig
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html

# Exec the given CMD (apache2-foreground) so signals are forwarded
exec "$@"
