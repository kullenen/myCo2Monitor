if which composer >/dev/null; then
	composer='composer'
elif [ -f composer.phar ]; then
	composer='php composer.phar'
else
	# Install composer
	php -r "readfile('https://getcomposer.org/installer');" | php
	composer='php composer.phar'
fi

echo "Starting install...\n"

$composer install

echo "\nDone."
