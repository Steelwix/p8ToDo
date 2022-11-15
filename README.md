How to install ToDo :

1. Clone the project on the folder you want the project to be with the command "git clone https://github.com/Steelwix/p8ToDo"

2. In the .env file, modify the DATABASE_URL parameters to match your database system.

3. Load the datas in your database with the command "symfony console doctrine:fixtures:load"

4. Run the project with the command "symfony serve -d --no-tls", you may need to replace the IP address with "localhost".

5. Now you can log on the app
    ADMIN account : {
    "username": "Steelwix",
    "password": "motdepasse"
}
    USER account : {
    "username": "Mael",
    "password": "motdepasse"
}

