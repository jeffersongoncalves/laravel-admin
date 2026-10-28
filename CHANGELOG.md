# Changelog

All notable changes to this project will be documented in this file.

## 1.0.2 - 2026-10-28

Tests now load the package migrations with jeffersongoncalves/pest-plugin-database-migrations, in the order declared by the service provider, instead of copying the .php.stub files by hand. No runtime changes.

## 1.0.1 - 2026-09-26

Security: require laravel/framework ^12.61.1|^13.12.0 (patched for GHSA-5vg9-5847-vvmq and GHSA-crmm-hgp2-wgrp). Drops Laravel 11 support.

## 1.0.0 - 2026-09-26

First release: base Admin model, admin guard/provider/password broker (only when not defined in config/auth.php), admins migration, factory and observer.

## [Unreleased]
