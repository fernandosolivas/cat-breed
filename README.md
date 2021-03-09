<p align="center">
    <h1 align="center">Cat Breed PHP</h1>
    <br>
</p>

Cat Breed is a project written in PHP to achieve the goals from [this](https://github.com/bsato212/php-interview-project) repository.

DIRECTORY STRUCTURE
-------------------

      clients/            contains classes that integrate with external APIs
      builders/           contains builders to create objects
      services/           contains service layer to centralize business logic
      assets/             contains assets definition
      config/             contains application configurations
      controllers/        contains Web controller classes
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources


REQUIREMENTS
------------
You need to have [Docker](https://docs.docker.com/get-docker/) installed and a valid API KEY to use in the integration with [Cat API](https://thecatapi.com/).

INSTALLATION
------------

### Install with Docker

Update your vendor packages

    docker-compose run --rm php composer update --prefer-dist
    
Run the installation triggers (creating cookie validation code)

    docker-compose run --rm php composer install    
    
Start the container

    docker-compose up -d
    
You can then access the application through the following URL:

    http://127.0.0.1:8000

**NOTES:** 
- Minimum required Docker engine version `17.04` for development (see [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- The default configuration uses a host-volume in your home directory `.docker-composer` for composer caches.
- If you get any errors related to write permissions in ./app/web/assets folder, please read [this](https://stackoverflow.com/questions/34482597/yii2-the-directory-is-not-writable-by-the-web-process-frontend-web-assets) thread

CI/CD
-------

The CI/CD runs in GitHub actions, and the manifest file is located at <root-dir>/.github/workflows/build-and-deployment.yml.
If you need more information about what is and how to use GitHub Actions, click [here](https://github.com/features/actions).

### Deployment
After the GitHub Action ends, the application will be live at https://cat-breed.monoviagem.com.