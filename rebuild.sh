#!/bin/bash
php symfony propel:build-sql
php symfony propel:build-model
php symfony propel:build-forms
php symfony propel:build-filters
php symfony propel:insert-sql
