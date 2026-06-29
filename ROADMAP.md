# Senso Schema Roadmap

## Philosophy

Senso Schema focuses on generating truthful, standards-compliant Schema.org markup for WordPress and WooCommerce.

The plugin does not generate fabricated data and does not require unnecessary configuration.

---

# v0.3.2 — Stabilization

### Core

* [ ] JSON-LD output hardening (`JSON_HEX_*`)
* [ ] Improve WooCommerce BreadcrumbList
* [ ] Review `ProductData::$specialty`
* [ ] Final cleanup after code audit

---

# v0.4 — Better WooCommerce Schema

### Pages

* [ ] CollectionPage for WooCommerce categories
* [ ] Improved WebPage schema
* [ ] Better Product category support

### Product

* [ ] Product ImageObject
* [ ] Better category detection
* [ ] Better additionalProperty mapping

---

# v0.5 — Rich Product Data

### Product

* [ ] AggregateRating
* [ ] Review
* [ ] GTIN / GTIN8 / GTIN13 / GTIN14 support
* [ ] MPN support
* [ ] Brand improvements

---

# v0.6 — Organization

* [ ] sameAs support
* [ ] Social profiles
* [ ] ContactPoint
* [ ] Merchant improvements

---

# v0.7 — Validation

* [ ] Google Rich Results optimization
* [ ] Schema.org validation
* [ ] Performance optimization
* [ ] Final architecture review

---

# v1.0 — Production Release

* [ ] Complete Schema coverage
* [ ] Google Rich Results validation
* [ ] Schema.org validation
* [ ] Stable public release

---

## Project Principles

* Truthful structured data only
* No fake reviews
* No fake ratings
* No fake GTIN
* WordPress native
* WooCommerce native
* Zero external dependencies
* Small focused classes
* One logical change per commit
