# <ins>[[PPE-SYMFONY](https://github.com/Naegato/PPE-SYMFONY)]

## Information :

Goal : Create a rental management platform.

Used technologies: SYMFONY | HTML | CSS | PHP | BOOTSTRAP | JavaScripts | MySQL

Realization period: End of December 2021 to April 25, 2022.

## How to launch the project ?

First type this command to install and build the project

        npm install
        npm run build

If the database wasn't create run 

        php bin/console doctrine/database/create

To fill the database run

        php bin/console doctrine:schema:update --dump-sql --force

After making sure that the database has been filled and the project has been built you can type

        symfony server:start

Made by Wiatr Maxime ([@Naegato](https://github.com/Naegato)) and Menard Maxence ([@Eadgeez](https://github.com/Eadgeez))
