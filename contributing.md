# Contributing to WireUI

We welcome contributions from everyone, and are grateful for the time and effort spent by contributors.
This document provides guidelines and steps for contributing to WireUI.

## Table of Contents

-   [Before You Start](#before-you-start)
-   [Setting Up Your Environment](#setting-up-your-environment)
-   [Working on a Local Project](#working-on-a-local-project)
-   [Submitting Your Contributions](#submitting-your-contributions)

## Before You Start

-   Please ensure you have reviewed [our documentation](https://wireui.dev) to familiarize yourself with the project.
-   If you encounter issues with any of our components, we encourage you to [open a new issue](https://github.com/wireui/wireui/issues). Before doing so, please check for existing issues to avoid duplicates and continue the discussion there if the issue has already been reported.
-   If you're planning to submit a pull request, kindly [open a new issue](https://github.com/wireui/wireui/issues) detailing your plans to ensure we're not working on the same feature/bug fix. We're always excited to review and discuss your code!

## Setting Up Your Environment

1. **Clone the repository and install dependencies:**

    ```shell
    git clone git@github.com:wireui/wireui.git

    cd wireui

    composer install

    yarn install
    ```

2. **Build assets:**

    ```shell
    yarn build
    ```

    2.1 **Watch and build assets:**

    ```shell
    yarn build
    ```

3. **Running Tests:**

    Make sure you have a chromium-based browser installed for running tests.

    ```shell
    yarn test

    composer test
    ```

4. **Code Formatting:**
   We adhere to a coding standard to maintain consistency. Before submitting your PR, ensure your code is formatted by running:

    ```shell
    yarn lint

    composer pint
    ```

## Working on a Local Project

1. **Create a new Laravel project:**

    ```shell
    composer create-project laravel/laravel wireui-demo

    cd wireui-demo
    ```

2. **Link local wireui into composer.json**

    ```json
    "repositories": {
        "local": {
            "type": "path",
            "url": "../path/to/wireui"
        }
    }
    ```

3. **Install WireUI as a local dependency:**

    ```shell
    composer require wireui/wireui
    ```

4. **Complete the setup:**

    Follow the WireUI [installation instructions](https://wireui.dev/getting-started) to finish the setup.

5. **You're ready to contribute! 🎉**

## Submitting Your Contributions

Head over to the Pull Requests section in GitHub and create a new pull request.

Please provide a clear description of the changes you made, and reference any related issues.

We look forward to your contributions!
