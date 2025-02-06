#!/bin/bash

echo "Début de l'installation du projet Laravel..."

# Installer les dépendances via Composer
composer install

# Configurer les permissions pour les dossiers nécessaires
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Générer la clé de l'application
php artisan key:generate

# Créer le fichier .env si n'existe pas encore
if [ ! -f .env ]; then
    cp .env.example .env
    echo "Fichier .env créé à partir de .env.example"
fi

# Demander les informations de configuration pour la base de données
echo "Configurer la base de données..."
read -p 'Nom de la base de données: ' dbname
read -p 'Utilisateur de la base de données: ' dbuser
read -sp 'Mot de passe de la base de données: ' dbpass
echo ""

# Remplir les informations dans le fichier .env
sed -i "s/DB_DATABASE=laravel/DB_DATABASE=$dbname/" .env
sed -i "s/DB_USERNAME=root/DB_USERNAME=$dbuser/" .env
sed -i "s/DB_PASSWORD=/DB_PASSWORD=$dbpass/" .env

# Migrer la base de données
php artisan migrate --seed

# Installer les dépendances npm et compiler les fichiers
npm install
npm run build

echo "Installation terminée ! Vous pouvez maintenant lancer le serveur avec 'php artisan serve'."
