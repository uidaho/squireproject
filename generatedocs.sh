#!/bin/sh
apigen generate --source ./app --exclude=*/commands/*,*/config/*,*/database/*,*/lang/*,*/start/*,*/storage/*,*/views/*,filters.php,routes.php --destination ./public/docs --no-source-code