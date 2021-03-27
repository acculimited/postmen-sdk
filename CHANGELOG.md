# Postmen SDK Change Log

## 2.0.0 (2021-03-27)
Utilising JSON Schema Validations
### Added
 - [JSON schema validations](./resources/schemas/com.postmen.api) for the postmen.com API
 - Service Options: `CashOnDelivery`, `Insurance`, `Pickup`

## 1.2.1 (2021-03-10)
### Added
 - Ability to add Service Options to a label creation request
### Removed
 - Paperless invoice service option on all requests.
   This is not supported for all carriers!

## ⚠️ 1.2.0 ⚠️ (2021-03-10)
### Added
 - Paperless invoice service option

## 1.1.0 (2021-01-08)
## Added
 - Introduced new unit tests for error handling
## Changed
 - Error handling now passes through the `Guzzle RetryMiddleware` to allow
   for automatic request retries and delay logic

## 1.0.1 (2020-12-31)
### Fixed
 - Reset the Response stream for reading after the middleware runs

## 1.0.0 (2020-12-31)
Detached from internal Accu postmen-client
### Added
 - Entities to act as data-transfer objects
 - Requests with fluent interfaces to return hydrated Entities
