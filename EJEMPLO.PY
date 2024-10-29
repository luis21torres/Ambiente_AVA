import requests
from bs4 import BeautifulSoup

# Función para realizar web scraping
def scrape_web(url):
    # Realiza una solicitud GET a la URL
    response = requests.get(url)
    
    # Verifica si la solicitud fue exitosa (código 200)
    if response.status_code == 200:
        # Parsea el contenido HTML de la página
        soup = BeautifulSoup(response.content, 'html.parser')
        
        # Extrae el título de la página
        page_title = soup.title.string if soup.title else "Sin título"

        # Ejemplo de extracción de todos los encabezados h1 de la página
        h1_tags = [h1.get_text(strip=True) for h1 in soup.find_all('h1')]
        
        # Ejemplo de extracción de todos los párrafos (p)
        paragraphs = [p.get_text(strip=True) for p in soup.find_all('p')]
        
        # Retorna los datos extraídos
        return {
            'titulo': page_title,
            'h1_tags': h1_tags,
            'parrafos': paragraphs
        }
    else:
        return f"Error: No se pudo acceder a la página. Código de estado: {response.status_code}"

# URL a la que deseas hacer scraping
url = "https://www.ucundinamarca.edu.co/"

# Llamada a la función
datos = scrape_web(url)

# Imprimir resultados
print("Título de la página:", datos['titulo'])
print("Encabezados H1:", datos['h1_tags'])
print("Párrafos encontrados:", datos['parrafos'][:5])  # Imprime los primeros 5 párrafos
