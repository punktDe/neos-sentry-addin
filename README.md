# [neos-sentry-addin](https://github.com/punktDe/neos-sentry-addin)

This is a Neos extension that adds several variables to Sentry error reports
sent by [networkteam/Networkteam.SentryClient](https://github.com/networkteam/Networkteam.SentryClient).

## Variables

### environment

Can be configured. Default is

 ```yaml
 PunktDe:
   SentryAddin:
     environment: '%env:SENTRY_ENVIRONMENT%'
 ```

### release

Via `RELEASE_*` file

### app_path

`FLOW_PATH_ROOT`
