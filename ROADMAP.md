# Senso Schema Roadmap

## Vision

Senso Schema is a lightweight, developer-friendly WordPress plugin that automatically generates truthful, standards-compliant Schema.org markup for WooCommerce.

The project prioritizes correctness, maintainability and automation over configuration.

---

## Project Principles

* Truthful structured data only
* No fake reviews or ratings
* No fake GTIN or product identifiers
* WordPress native
* WooCommerce native
* Zero external dependencies
* Clean architecture
* One logical change per commit
* Performance first
* Google Rich Results compatibility

---

# v0.3.2 — Stabilization

Focus: improve the existing implementation without adding major features.

### Core

* [ ] Harden JSON-LD output (`JSON_HEX_*`)
* [ ] Improve WooCommerce BreadcrumbList
* [ ] Decide the future of `ProductData::$specialty`

### Quality

* [ ] Final review after cleanup
* [ ] Improve internal documentation

---

# v0.4 — WooCommerce Schema

Focus: improve store and category markup.

### Collection Pages

* [ ] CollectionPage schema
* [ ] Product category schema
* [ ] Better category detection

### Product

* [ ] Product ImageObject
* [ ] Better additionalProperty mapping

### WebPage

* [ ] Improve WebPage relationships

---

# v0.5 — Rich Product Schema

Focus: richer product information.

### Product

* [ ] AggregateRating
* [ ] Review
* [ ] Product identifiers (GTIN)
* [ ] MPN support
* [ ] Brand improvements

---

# v0.6 — Organization & Merchant

Focus: better organization identity.

* [ ] sameAs
* [ ] ContactPoint
* [ ] Merchant improvements
* [ ] Organization enhancements

---

# v0.7 — Production Readiness

Focus: release preparation.

* [ ] Google Rich Results optimization
* [ ] Schema.org validation
* [ ] Performance review
* [ ] Architecture review
* [ ] Documentation review

---

# v1.0 — Stable Release

Focus: first production release.

* [ ] Complete Schema coverage
* [ ] Google Rich Results validation
* [ ] Schema.org validation
* [ ] Stable public release
* [ ] Long-term backward compatibility

---

## Future Ideas

These ideas are intentionally outside the current roadmap.

* Multi-brand support
* LocalBusiness support
* FAQPage where appropriate
* HowTo where appropriate
* Additional Schema types
* Optional integrations with other plugins
