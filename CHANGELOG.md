# Senso Schema

Custom Schema.org generator for the SENSO COFFEE WooCommerce website.

The plugin generates clean JSON-LD without relying on third-party SEO plugins.

v1.0.0

Initial production release.

Implemented:

- Organization
- WebSite
- WebPage
- Product
- Offer
- Brand
- BreadcrumbList
- MerchantReturnPolicy
- Product gallery images
- Product URL in Offer
- Organization contact information
- Secure JSON-LD output
- PHP 8.3 compatibility
- WooCommerce 10 compatibility

Production-ready for SENSO COFFEE.

## v0.2.6

### Added
- Configurable export rules for WooCommerce attributes.
- Configurable suffixes (e.g. `g`, `MASL`).
- Automatic AdditionalProperty generation from WooCommerce attributes.

### Improved
- Attribute names are now mapped through `Config::PRODUCT_PROPERTIES`.

## [0.3.0] - 2026-06-29

### Added
- Added `sku` to Product schema.
- Added `Product.category` from WooCommerce `product_cat`.
- Added `Product.mainEntityOfPage` reference to `WebPage`.

### Improved
- MerchantReturnPolicy included in both Organization and Offer for Google Merchant compatibility.
- Implemented OfferShippingDetails.

### Removed
- Removed WooCommerceInspector debug logging from Plugin.

### Notes
- `review` and `aggregateRating` are intentionally omitted because product reviews are disabled.
- `shippingRate` is intentionally omitted because shipping cost depends on carrier and order amount.