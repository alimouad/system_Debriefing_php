<?php

$driver = getenv('DATABASE_DRIVER') ?? 'pgsql';
$host = getenv('DATABASE_HOST') ?? 'localhost';
$port = getenv('DATABASE_PORT') ?? 5432;
$user = getenv('DATABASE_USER') ?? 'mouad';
$pass = getenv('DATABASE_PASSWORD') ?? 'mouad1411';
$dbname = getenv('DATABASE_NAME') ?? 'debri_db';


