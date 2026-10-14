from src.request import Request
from src.response import Response
from src.router import Router

def accueil(request):
    return Response.html("<h1>Accueil</h1>")

routeur = Router()
routeur.add_route("GET", "/", accueil)

print(routeur.resolve(Request("GET", "/")).status())              # 200
print(routeur.resolve(Request("GET", "/nimportequoi")).status())  # 404
print(routeur.resolve(Request("POST", "/")).status())             # 405