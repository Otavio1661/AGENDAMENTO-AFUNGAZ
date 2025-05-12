<?php

namespace src;

require_once __DIR__ . '/Env.php';

class Config
{
    // Definição das constantes
    const BASE_DIR = BASE_DIR;
    const URL_ADMIN = URL_ADMIN;
    const SENTRY_DSN = SENTRY_DSN;
    const TOKEN_JV = TOKEN_JV;

    const URL_API_GAZIN = URL_API_GAZIN;
    const API_GAZIN_USERNAME = API_GAZIN_USERNAME;
    const API_GAZIN_PASSWORD = API_GAZIN_PASSWORD;

    const SB_DRIVER = SB_DRIVER;
    const SB_USER = SB_USER;

    const SB_PASS = SB_PASS;
    const SB_HOST = SB_HOST;
    const SB_PORT = SB_PORT;
    const SB_DATABASE = SB_DATABASE;

    const SB_TES_DRIVER = SB_TES_DRIVER;
    const SB_TES_USER = SB_TES_USER;
    const SB_TES_PASS = SB_TES_PASS;
    const SB_TES_HOST = SB_TES_HOST;
    const SB_TES_PORT = SB_TES_PORT;
    const SB_TES_DATABASE = SB_TES_DATABASE;
    const ERROR_CONTROLLER = ERROR_CONTROLLER;
    const DEFAULT_ACTION = DEFAULT_ACTION;

}
