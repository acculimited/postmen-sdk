# Postmen SDK Change Log

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