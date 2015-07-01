#!/usr/bin/env bash

#
# Should be executed under sudo
#
chmod 0400 ./test/_data/non.readable.txt
chown www-data:www-data ./test/_data/non.readable.txt
