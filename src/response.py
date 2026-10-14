import json


class Response:
    def __init__(self, body="", status=200, headers=None):
        self._body = body
        self._status = status
        
        if headers is None : 
            headers = {}
        self._headers = headers

    def body(self):
        return self._body

    def status(self):
        return self._status

    def headers(self):
        return self._headers


    @staticmethod
    def html(content, status=200):
        return Response(
        body=content,
        status=status,
        headers={"Content-Type": "text/html; charset=utf-8"},
    )

    @staticmethod
    def json(data, status=200):
        return Response(
        body=json.dumps(data),
        status=status,
        headers={"Content-Type": "application/json; charset=utf-8"},
    )

    @staticmethod
    def redirect(url):
        return Response(
            body="",
            status=302,
            headers={"Location": url},
    )