from urllib.parse import urlparse


class Request:
    def __init__(self, method, uri, query=None, body=None):
        self._method = method.upper()
        self._uri = urlparse(uri).path or "/"

        if query is None:
            query = {}
        if body is None:
            body = {}
        self._query = query
        self._body = body

    def method(self):
        return self._method

    def uri(self):
        return self._uri

    def query(self, key, default=None):
        return self._query.get(key, default)

    def input(self, key, default=None):
        return self._body.get(key, default)