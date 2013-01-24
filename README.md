# _HUGnetLab_

This is a user interface for the HUGnet system written in JavaScript.  There are two
different packages here.  HUGnetView is a read-only viewer that will display the data.
HUGnetLab is the user interface to configure the HUGnet system.

## Project Setup

### Directory Structure
This project is broken up into the following directories:

- The build/ directory contains build scripts, and other things useful for building the project
- The deb/ directory contains the base files for the debs
- The html/ directory contains the source code for HUGnetLab
- The view/ directory contains the source code for HUGnetView
- The include/ directory includes the php templating engine, as well as some hugnet stuff.

### Requirements
#### HUGnetLab
 - HUGnetLib Web API must be installed on the same computer as HUGnetLab.
 - Web Server with PHP

#### HUGnetView
The HUGnetView software is configurable as to where it gets its data.  It must be pointed
to a computer with HUGnetLab on it.

 - Web Server with PHP

### Setup

To function properly, the following must be in place:

1. ./include should be installed in the php_include path as ./HUGnetLab/

On Linux systems, this can be accomplished by symbolic links when working on the code.
For example, in Ubuntu, you could create the following symbolic links:

- /usr/share/php/HUGnetLab -> /your/code/path/HUGnetLab.git/include

## Testing
There is currently no unit testing for this project.

## Deploying

### Ubuntu
Currently there are only build scripts for building .deb files for Ubuntu.  They are
created by running 'ant deb'.  The debs will be in the ./rel directory.


## Troubleshooting & Useful Tools

This uses a HUGnet javascript library that is incuded in HUGnetLib.

## Contributing Changes

_All commit messages need to reference bugs in the Mantis bug tracker (see below)_

Changes can be contributed by either:

1. Using git to create patches and emailing them to patches@hugllc.com
2. Creating another github repository to make your changes to and submitting pull requests.

## Git Checkins
All git checkins MUST REFERENCE A BUG in Mantis.  This can be done in a number of ways.
The commit message should contain one of the following forms:

- bug #XXXX
- fixed #XXXX
- fixes #XXXX

## Filing Bug Reports
The bug tracker for this project is at http://dev.hugllc.com/bugs/ .  If you want an
account on that site, please email prices@hugllc.com.

## License
This is released under the GNU GPL V3.  You can find the complete text in the
LICENSE file, or at http://opensource.org/licenses/gpl-3.0.html