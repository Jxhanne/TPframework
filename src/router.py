from src.response import Response


class Router:
    def __init__(self):
        self.routes = []

    def add_route(self, method, path, handler):
        self.routes.append({
            "method": method,
            "path": path,
            "handler": handler
        })

    def resolve(self, request):
        chemin_existe = False

        for route in self.routes:
            if route["path"] == request.uri():
                if route["method"] == request.method():
                    return route["handler"](request)
                else:
                    chemin_existe = True

        if chemin_existe:
            return Response.html("<h1>405 Method Not Allowed</h1>", 405)

        return Response.html("<h1>404 Not Found</h1>", 404)