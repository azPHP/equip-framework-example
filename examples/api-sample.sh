#/bin/bash

# We are running things in dev mode with whoops enabled, so set an accept header, so we get text errors
curl -H "Accept: text/plain" -X DELETE localhost:8000/users/foo
curl -H "Accept: text/plain" -X POST --data "username=foo&name=foo+bar" localhost:8000/users
curl -H "Accept: text/plain" -X DELETE localhost:8000/users/foo
curl -H "Accept: text/plain" -X POST --data "username=foo&name=foo+bar" localhost:8000/users
curl -H "Accept: text/plain" -X GET localhost:8000/users/
curl -H "Accept: text/plain" -X GET localhost:8000/users/foo
