# Senso Schema Architecture

## Principles

- WordPress native
- Zero dependencies
- One responsibility per class
- Registry based
- Graph based
- No magic
- No service container
- No dependency injection
- No factories without necessity

## Folder structure

Contracts

Core

Schema

WooCommerce

## Output

SchemaManager

↓

Graph

↓

Registry

↓

Nodes

↓

JSON-LD