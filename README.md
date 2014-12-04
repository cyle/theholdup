# The Hold Up

I commonly find myself at work with way too many projects and no simple way to track them all in one place.

And I think [Basecamp]() is great, [Trello]() is neat, and all the other project management apps and services out there are wonderful. But I want something really, really simple.

The name of a project, and its most recent status. Most likely that status is a reason why it's being held up. Hence, the title of this application.

## Installation/Requirements

Requires PHP 5.4+, the mysqli extension, a MySQL database, and some kind of authentication mechanism.

You will need to code in your own auth method into `logincheck.php`.

To install the database, use `theholdup.sql`. Then, rename `dbconn_mysql.sample.php` to `dbconn_mysql.php` and fill it out with the relevant info.

## Usage

On first login, you'll automatically be provisioned a workspace to use. Use the small form at the bottom of the index page to add a project. Double-click on the title of a project to rename it, double-click on its current status to update that status, drag and drop the projects to reorder them, click the DONE checkbox when it's done. Could not be more simple, I think.

There's the option to make your list of projects (without their statuses) public, and also the option to see all of your projects, including your "done" ones.

Enjoy!