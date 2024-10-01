from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time

# Inicializando o WebDriver do Firefox
driver = webdriver.Firefox()

# Abrindo o site do Instagram
driver.get('https://www.instagram.com/accounts/login/')

# Espera para garantir que a página carregue corretamente
time.sleep(3)

# Encontrar os campos de login e senha
username_input = driver.find_element(By.NAME, 'username')
password_input = driver.find_element(By.NAME, 'password')

# Inserir as credenciais
username = 'seu_usuario'
password = 'sua_senha'
username_input.send_keys(username)
password_input.send_keys(password)

# Pressionar ENTER para logar
password_input.send_keys(Keys.RETURN)

# Espera o login processar (ajuste o tempo se necessário)
time.sleep(5)

# Capturar os cookies
cookies = driver.get_cookies()

# Procurar o cookie que contém o 'csrftoken'
csrftoken = None
for cookie in cookies:
    if cookie['name'] == 'csrftoken':
        csrftoken = cookie['value']
        break

# Capturar o valor do cabeçalho 'X-csrftoken'
headers = {
    'Cookie': "; ".join([f"{cookie['name']}={cookie['value']}" for cookie in cookies]),
    'X-csrftoken': csrftoken
}

# Exibir os cookies e o cabeçalho
print("Cookies: ", headers['Cookie'])
print("X-csrftoken: ", headers['X-csrftoken'])

# Fechar o navegador
driver.quit()
