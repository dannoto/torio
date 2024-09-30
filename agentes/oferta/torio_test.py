# proxima melhoria
# colocar update_oferta(oferta_data['id'], 1, demanda['id']) 
# logo após input de enviar mensagem pra evitar possiveis erros e deixar a demanda como nao-processada
import sys
import requests
import tarfile
import os
import platform
from selenium import webdriver
from selenium.webdriver.firefox.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
from faker import Faker
import http.client
import hashlib
import time
import json
import re
from urllib.parse import urlparse
import time
import datetime
import random
import winsound

# Foto de perfil, feed e Imagem

# def initiaLsetup_bio():

# def initiaLsetup_perfil():

# def initiaLsetup_feed():

# def initial_setup():

#     initial_setup_bio()

#     initial_setup_perfil()

#     initial_setup_feed()

# Fechar navegador e reabre e loga novamente.
def reload(driver, agente_data):

        print("\n==== FUNÇÃO RELOAD - AGENTE  ==== \n")
        print(f"\n [#{agente_data['id']}] [{agente_data['agente_nome']}] [{agente_data['agente_email']}] \n ")


        try:

            
            update_agente_ocupado(agente_data['id'], 0)


            try:

                
                driver.close()
                # driver.quit()

                return True
            
            except Exception as e:
                print(f"\n  [*] Erro em reload - driver.quit(): {e}")                            
                winsound.Beep(1000, 500)
                
                # Tentar forçar o fechamento do processo
                try:
                    os.system("taskkill /im chromedriver.exe /f")
                    os.system("taskkill /im chrome.exe /f")

                    return True
                
                except Exception as kill_error:

                    print(f"\n  [*] Erro ao forçar o fechamento: {kill_error}")
                    return False
       
        except:

            print('\n  [*] Erro em reload Final - driver.quit()')                            
            winsound.Beep(1000, 500)  

            return False

def get_latest_geckodriver_version():
    url = "https://api.github.com/repos/mozilla/geckodriver/releases/latest"
    response = requests.get(url)
    data = response.json()
    return data['tag_name']

def download_geckodriver(version):
    system = platform.system().lower()
    if 'windows' in system:
        url = f"https://github.com/mozilla/geckodriver/releases/download/{version}/geckodriver-{version}-win64.zip"
        file_name = "geckodriver.zip"
    elif 'linux' in system:
        url = f"https://github.com/mozilla/geckodriver/releases/download/{version}/geckodriver-{version}-linux64.tar.gz"
        file_name = "geckodriver.tar.gz"
    elif 'darwin' in system:
        url = f"https://github.com/mozilla/geckodriver/releases/download/{version}/geckodriver-{version}-macos.tar.gz"
        file_name = "geckodriver.tar.gz"
    else:
        raise Exception("Sistema operacional não suportado")
    
    response = requests.get(url)
    with open(file_name, 'wb') as file:
        file.write(response.content)
    
    return file_name

def extract_geckodriver(file_name):
    if file_name.endswith('.tar.gz'):
        with tarfile.open(file_name, "r:gz") as tar:
            tar.extractall()
    elif file_name.endswith('.zip'):
        import zipfile
        with zipfile.ZipFile(file_name, 'r') as zip_ref:
            zip_ref.extractall()

def open_firefox():
    # Obtém a versão mais recente do geckodriver
    version = get_latest_geckodriver_version()
    print(f"Última versão do geckodriver: {version}")
    
    # Baixa o geckodriver
    file_name = download_geckodriver(version)
    
    # Extrai o geckodriver
    extract_geckodriver(file_name)

def login(driver, agente_data, demanda): 


    email_id = generateTempEmail()

     # trigger to login
    try:
        email = driver.find_element(By.CSS_SELECTOR, "div._aahy:nth-child(4) > div:nth-child(1) > label:nth-child(1) > input:nth-child(2)")
        email.clear()  
        email.send_keys(agente_data['agente_username'])
    except:
        print('EMAIL')
        driver.get("https://www.instagram.com/accounts/login/?next=%2Flogin%2F&source=desktop_nav")

    # trigger to login

def login_old(driver, agente_data, demanda): 

    # ocupando agente

    

    # ocupando agente

    driver.get("https://www.instagram.com/" + demanda['username'])

    time.sleep(10)
    
    # trigger to login
    try:
        btn_login_click = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/div/div/div[1]/div[2]/div/div[2]/div/div[1]/div/div/div[3]/div[1]/a")
        btn_login_click.click()
    except:
        print('ERRO DE CARREGAMENTO INICIAL')
        driver.get("https://www.instagram.com/accounts/login/?next=%2Flogin%2F&source=desktop_nav")

    # trigger to login

    time.sleep(5)

    try:

        print('  [*****] PRIMEIRA TENTATIVA DE LOGIN [*****]')

        # put username
        input_username = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/div/div/div[1]/div[1]/div/section/main/div/div/div[1]/div[2]/div/form/div/div[1]/div/label/input")
        input_username.clear()  # Limpa o campo de texto, caso haja algum valor anterior
        input_username.send_keys(agente_data['agente_username'])  # Insere o valor no campo de input
        # put username

        time.sleep(5)

        # put password
        input_password = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/div/div/div[1]/div[1]/div/section/main/div/div/div[1]/div[2]/div/form/div/div[2]/div/label/input")
        input_password.clear()  # Limpa o campo de texto, caso haja algum valor anterior
        input_password.send_keys(agente_data['agente_senha'])  # Insere o valor no campo de input
        # put password

        time.sleep(5)

        # login button
        
        try:
            login_button = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/div/div/div[1]/div[1]/div/section/main/div/div/div[1]/div[2]/div/form/div/div[3]/button")
            login_button.click()
            return True
        except:
            pass
        
        
    
    except:

        print('    [!] FALHOU A PRIMEIRA TENTATIVA DE LOGIN')

    # login button

    time.sleep(10)

    try:

        print('  [*****] SEGUNDA TENTATIVA DE LOGIN [*****]')
                
        input_username_dois = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/div/div/div[1]/div[1]/div/section/main/article/div[2]/div[1]/div[2]/div/form/div/div[1]/div/label/input")
        input_username_dois.clear()  
        input_username_dois.send_keys(agente_data['agente_username'])
        time.sleep(5)
        input_password_dois = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/div/div/div[1]/div[1]/div/section/main/article/div[2]/div[1]/div[2]/div/form/div/div[2]/div/label/input")
        input_password_dois.clear()  
        input_password_dois.send_keys(agente_data['agente_senha'])
        time.sleep(5)
        login_button_dois = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/div/div/div[1]/div[1]/div/section/main/article/div[2]/div[1]/div[2]/div/form/div/div[3]")
        login_button_dois.click()

        return True

    except:

        print('    [!] FALHOU A SEGUNDA TENTATIVA DE LOGIN')
    
    return False

def pequena_interacao() :
    return True

def enviar_oferta():
    return True

def get_campanha_ofertas(campanha_id):

    url = base_url+"/get_campanha_ofertas?campanha_id"+str(campanha_id)
        
    response = requests.get(url)

    # print(response.content)
    if response.status_code == 200:
            
        data = json.loads(response.content)
       
        return data
        
    else:

        return False  

def count_agentes_oferta(agente_id) :
    url = base_url+"/count_agentes_oferta?agente_id="+str(agente_id)

    # print(url)
        
    response = requests.get(url)

    # print(response.content)
    if response.status_code == 200:
            
        data = json.loads(response.content)
       
        return data
        
    else:

        return False  

def get_campanhas_ativas(base_url):

    url = base_url+"/get_campanhas_ativas"
        
    response = requests.get(url)

    # print(response.content)
    if response.status_code == 200:
            
        data = json.loads(response.content)
       
        return data
        
    else:

        return False   
                  
def get_demandas_por_campanha(base_url, campanha_id):
 
    url = base_url+"/get_demandas_por_campanha?campanha_id="+str(campanha_id)+""
        
    response = requests.get(url)

    if response.status_code == 200:
            
        data = json.loads(response.content)
   
        return data
        
    else:

        return False   

def get_templates_oferta(base_url, campanha_id) :
 
    url = base_url+"/get_templates_oferta?campanha_id="+campanha_id

        
    response = requests.get(url)

    if response.status_code == 200:

            
        data = json.loads(response.content)
   
        return data
        
    else:

        return False   

def get_agentes(base_url) :
 
    url = base_url+"/get_agentes_livres"
        
    response = requests.get(url)

    if response.status_code == 200:
            
        data = json.loads(response.content)
   
        return data
        
    else:

        return False   

def get_ofertas_pendentes(agente_id) :
       
    url = base_url+"/get_ofertas_pendentes?agente_id="+str(agente_id)+""
        
    response = requests.get(url)

    if response.status_code == 200:
            
        data = json.loads(response.content)
   
        return data
        
    else:

        return False   

def update_agente_ocupado(agente_id, agente_ocupado):

    print('UPDATE AGENTE OCUPADO: ', agente_id)

    url = base_url+"/update_agente_ocupado?agente_id="+str(agente_id)+"&agente_ocupado="+str(agente_ocupado)+""
    # print(url)        
    response = requests.get(url)

    if response.status_code == 200:
            
        data = json.loads(response.content)
   
        return data
        
    else:

        return False 
    
def update_agente_banido(agente_id, agente_status):

    print('UPDATE AGENTE BANIDO: ', agente_id)

    url = base_url+"/update_agente_banido?agente_id="+str(agente_id)+"&agente_status="+str(agente_status)+""
    # print(url)        
    response = requests.get(url)

    if response.status_code == 200:
            
        data = json.loads(response.content)
   
        return data
        
    else:

        return False 

def update_oferta(oferta_id, oferta_status, demanda_id) :
       
    url = base_url+"update_oferta?oferta_id="+str(oferta_id)+"&oferta_status="+str(oferta_status)+"&demanda_id="+str(demanda_id)+""
    # print(url)        
    response = requests.get(url)

    if response.status_code == 200:
            
        data = json.loads(response.content)
   
        return data
        
    else:

        return False 
    
def update_oferta_data(oferta_id, demanda_id) :
       
    url = base_url+"/update_oferta_data?oferta_id="+str(oferta_id)+"&demanda_id="+str(demanda_id)+""
    print(url)
        
    response = requests.get(url)

    if response.status_code == 200:
            
        data = json.loads(response.content)
   
        return data
        
    else:

        return False 
    
def criar_oferta_pendente(agente_data, campanha_data, template_oferta, demanda, persona_id) :
       
    url = base_url+"criar_oferta_pendente?oferta_persona_id="+str(persona_id)+"&oferta_insta_id="+str(demanda['username'])+"&oferta_campanha_id="+str( campanha_data['id'])+"&oferta_oferta_id="+str(template_oferta['id'])+"&oferta_tag_id="+str(campanha_data['campanha_tag_id'])+"&oferta_produto_id="+str(campanha_data['campanha_produto_id'])+"&oferta_agente_id="+str(agente_data['id'])+"&is_deleted=0"
        
    response = requests.get(url)

    if response.status_code == 200:
            

        data = json.loads(response.content)
        return data
        
    else:

        return False 

def add_persona(agente_data, campanha_data, demanda):

    url = base_url+"add_persona?persona_nome="+str(demanda['full_name'])+"&persona_username="+str(demanda['username'])+"&persona_email=danrib2018@gmail.com"+"&persona_telefone=62993615459"+"&persona_tag_id="+str(campanha_data['campanha_tag_id'])+"&oferta_agente_id="+str(agente_data['id'])+"&is_deleted=0"
    
 
    response = requests.get(url)

    if response.status_code == 200:

            
        data = json.loads(response.content)

        # print('response.content', data)

        return data['persona_id']
        
    else:

        return False 

def send_oferta(demanda, template_oferta, campanha_data, agente_data, oferta_data, driver) :


    time.sleep(15)

    try:
    # Verificar se o elemento com o CSS selector '.wbloks_98' existe
        element = driver.find_element(By.CSS_SELECTOR, ".wbloks_98")
        winsound.Beep(1500, 800) 
        print("Sua conta foi banida")
        update_agente_banido(agente_data['id'], 0)
        return False
    except:
        print("Sua conta não foi banida")

    try:
        possivel_out = driver.find_element(By.CSS_SELECTOR, ".x1dr59a3 > div:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(3) > div:nth-child(2) > a:nth-child(1)")
        possivel_out.click()

        winsound.Beep(1000, 500) 
        winsound.Beep(1000, 500) 
            
        print(" =========== POSSIVELMENTE ERRO NO CADASTRO  =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO")
        update_agente_banido(agente_data['id'], 0)

        return False

    except:
        print('========== foi ========')
            
    
   

    driver.get('https://instagram.com/explore')

    county = 0
    max_iterationsj = 5  # Número máximo de vezes que o loop deve rodar

    try:

        while county < max_iterationsj:
            # Gera um intervalo de tempo aleatório entre 1 e 40 segundos
            wait_time = random.randint(1, 40)
            print(f"Aguardando por {wait_time} segundos...")

            # Espera pelo tempo gerado
            time.sleep(wait_time)               

            # Simula o pressionar da tecla para baixo
            body = driver.find_element(By.TAG_NAME ,'body')
            body.send_keys(Keys.ARROW_DOWN)

            print(f"Pressionando tecla para baixo. Iteração {count + 1}")

            # Incrementa o contador
            count += 1

    except:
        print('    [*] ERRO NO WHILE REELS')


# =========================================
     # # search button
    try:

        search_button = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div/div[2]/div/div/div[1]/div[1]/div[2]/div/div/div/div/div[2]/div[2]/span/div/a")
        search_button.click()

    except:
        print('   [***] PROVAVELMENTE NÃO LOGOU '+agente_data['agente_nome'])
        # return False
    # search button

    time.sleep(5)

     # input_search


    try:
        input_search = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div/div[2]/div/div/div[1]/div[1]/div[2]/div/div/div[2]/div/div/div[2]/div/div/div[1]/div/div/input")
        input_search.clear()  # Limpa o campo de texto, caso haja algum valor anterior
        input_search.send_keys(demanda['username'])  # Insere o valor no campo de input
    # input_search

        time.sleep(5)

    # click result
        click_result = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div/div[2]/div/div/div[1]/div[1]/div[2]/div/div/div[2]/div/div/div[2]/div/div/div[2]/div/a")
        click_result.click()

    except:
        print('olkdlskd')

    try:
    # Verificar se o elemento com o CSS selector '.wbloks_98' existe
        element = driver.find_element(By.CSS_SELECTOR, ".wbloks_98")
        winsound.Beep(1500, 800) 
        print("Sua conta foi banida")
        update_agente_banido(agente_data['id'], 0)
        return False
    except:
        print("Sua conta não foi banida")


    # click result

    time.sleep(5)

    try:
    # Verificar se o elemento com o CSS selector '.wbloks_98' existe
        element = driver.find_element(By.CSS_SELECTOR, ".wbloks_98")
        winsound.Beep(1500, 800) 
        print("Sua conta foi banida")
        update_agente_banido(agente_data['id'], 0)
        return False
    except:
        print("Sua conta não foi banida")
  
    time.sleep(60)

    # acessando perfil
    driver.get('https://instagram.com/'+demanda['username'])

    print('    [**] PROCESSANDO DEMANDA: '+demanda['username'])

    time.sleep(10)


    # CONTA PRIVADA
    try:
        conta_privada = driver.find_element(By.CSS_SELECTOR, ".x16n37ib > div:nth-child(1) > div:nth-child(1) > span:nth-child(1)")
        # conta_privada
        print('   [**] É CONTA PRIVADA')

        return False
        # CONTA PRIVADA_btn.click()
    except:
         print('   [**] NÃO É CONTA PRIVADA')
    # CONTA PRIVADA

 

    time.sleep(10)

    

    # seguir
    try:
        seguir_btn = driver.find_element(By.CSS_SELECTOR, "._acan")
        seguir_btn.click()
    except:
         print('   [**] ERRO NO BTN SEGUIR')
    # seguir

    time.sleep(5)

    try:

        btn_suggest = driver.find_element(By.CSS_SELECTOR, ".x1iorvi4 > div:nth-child(1)")
        btn_suggest.click()

    except:
        print('FALHA skip poup follow')
        # return False
    
    time.sleep(5)

    # possivel poupup
    try:
        poupup = driver.find_element(By.CSS_SELECTOR, "button._a9--:nth-child(2)")
        poupup.click()
    except:
         print('   [**] ERRO NO POUPUP')

    # possivel poupup

    
    time.sleep(5)

    try:
    # Verificar se o elemento com o CSS selector '.wbloks_98' existe
        element = driver.find_element(By.CSS_SELECTOR, ".wbloks_98")
        winsound.Beep(1500, 800) 
        print("Sua conta foi banida")
        update_agente_banido(agente_data['id'], 0)
        return False
    except:
        print("Sua conta não foi banida")

    try:
        possivel_out = driver.find_element(By.CSS_SELECTOR, ".x1dr59a3 > div:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(3) > div:nth-child(2) > a:nth-child(1)")
        possivel_out.click()

        winsound.Beep(1000, 500) 
        winsound.Beep(1000, 500) 
            
        print(" =========== POSSIVELMENTE ERRO NO CADASTRO  =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO")
        update_agente_banido(agente_data['id'], 0)

        return False

    except:
        print('========== foi ========')

    # btn enviar mensagem
    try:
        btn_enviar_mensagem = driver.find_element(By.CSS_SELECTOR, ".xjyslct")
        btn_enviar_mensagem.click()
    except:
        print('   [**] ERRO NO BTN ENVIAR MENSAGEM')
        # home
        try:
            btn_home = driver.find_element(By.CSS_SELECTOR, "div.x1iyjqo2:nth-child(2) > div:nth-child(1) > div:nth-child(1) > span:nth-child(1) > div:nth-child(1) > a:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > span:nth-child(1) > span:nth-child(1)")
            btn_home.click()
        except:
            print('   [**] ERRO NO BTN HOME')
        # home
        time.sleep(5)

        # stories
        try:
            btn_stories = driver.find_element(By.CSS_SELECTOR, ".x17j7krd > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > ul:nth-child(1) > li:nth-child(3) > div:nth-child(1) > button:nth-child(1) > div:nth-child(2) > div:nth-child(1)")
            btn_stories.click()
        except:
            print('   [**] ERRO NO BTN STORIES')

            try:
                btn_stories_dois = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div/div[2]/div/div/div[1]/div[1]/div[1]/section/main/div[1]/div[1]/div/div[1]/div/div/div/div/div/div/ul/li[3]/div/button")
                btn_stories_dois.click()
            except:
                print('   [**] ERRO NO BTN STORIES 2')
        # stories
        # time.sleep(120)
        return False
    # btn enviar mensagem

    time.sleep(5)

    # possivel poupup

    try:
        poupup = driver.find_element(By.CSS_SELECTOR, "button._a9--:nth-child(2)")
        poupup.click()
    except:
         print('   [**] ERRO NO POUPUP')

    # possivel poupup

    time.sleep(5)

    

    # btn clicar input
    try:

        oferta_url = "https://oferta.run/"+oferta_data['oferta_key']

        btn_clicar_input = driver.find_element(By.CSS_SELECTOR, "div.xzsf02u")
        btn_clicar_input.clear()  # Limpa o campo de texto, caso haja algum valor anterior
        # print('oferta: ' + template_oferta['oferta_conteudo'])
        
        # Percorre cada caractere da string e envia um por um
        for letra in template_oferta['oferta_conteudo']:
            btn_clicar_input.send_keys(letra)
            time.sleep(0.1)  # Pausa de 100ms entre cada letra (ajuste conforme necessário)

        btn_clicar_input.send_keys(Keys.SHIFT, Keys.ENTER)
        
        for letra in oferta_url:

            btn_clicar_input.send_keys(letra)
            time.sleep(0.1)  # Pausa de 100ms entre cada letra (ajuste conforme necessário)

        print('ATUALIZANDO MENSAGEM E DEMANDA - PROCESSADO DENTRO DO SEND-OFERTA')

        update_oferta(oferta_data['id'], 1, demanda['id'])


    except:
        print('   [**] ERRO NO INPUT ENVIAR MENSAGEM')
        # home
        try:
            btn_home = driver.find_element(By.CSS_SELECTOR, "div.x1iyjqo2:nth-child(2) > div:nth-child(1) > div:nth-child(1) > span:nth-child(1) > div:nth-child(1) > a:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > span:nth-child(1) > span:nth-child(1)")
            btn_home.click()
        except:
            print('   [**] ERRO NO BTN HOME')
        # home
        time.sleep(5)

        # stories
        try:
            btn_stories = driver.find_element(By.CSS_SELECTOR, ".x17j7krd > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > ul:nth-child(1) > li:nth-child(3) > div:nth-child(1) > button:nth-child(1) > div:nth-child(2) > div:nth-child(1)")
            btn_stories.click()
        except:
            print('   [**] ERRO NO BTN STORIES')

            try:
                btn_stories_dois = driver.find_element(By.CSS_SELECTOR, ".x1hq5gj4 > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > ul:nth-child(1) > li:nth-child(3) > div:nth-child(1) > button:nth-child(1) > div:nth-child(1)")
                btn_stories_dois.click()
            except:
                print('   [**] ERRO NO BTN STORIES 2')
        # stories
        # time.sleep(120)
        return False
    # btn clicar input




    # possivel poupup

    try:
        poupup = driver.find_element(By.CSS_SELECTOR, "button._a9--:nth-child(2)")
        poupup.click()
    except:
         print('   [**] ERRO NO POUPUP')

    # possivel poupup
    time.sleep(5)

    # enviar mensagem
    try:
        btn_enviar_mensagem = driver.find_element(By.CSS_SELECTOR, "div.xjqpnuy:nth-child(3)")
        btn_enviar_mensagem.click()
    except:
        print('   [**] ERRO NO BTN ENVIAR MENSAGEM')
        # home
        try:
            btn_home = driver.find_element(By.CSS_SELECTOR, "div.x1iyjqo2:nth-child(2) > div:nth-child(1) > div:nth-child(1) > span:nth-child(1) > div:nth-child(1) > a:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > span:nth-child(1) > span:nth-child(1)")
            btn_home.click()
        except:
            print('   [**] ERRO NO BTN HOME')
        # home
        time.sleep(5)

        # stories
        try:
            btn_stories = driver.find_element(By.CSS_SELECTOR, ".x17j7krd > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > ul:nth-child(1) > li:nth-child(3) > div:nth-child(1) > button:nth-child(1) > div:nth-child(2) > div:nth-child(1)")
            btn_stories.click()
        except:
            print('   [**] ERRO NO BTN STORIES')

            try:
                btn_stories_dois = driver.find_element(By.CSS_SELECTOR, ".x1hq5gj4 > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > ul:nth-child(1) > li:nth-child(3) > div:nth-child(1) > button:nth-child(1) > div:nth-child(1)")
                btn_stories_dois.click()
            except:
                print('   [**] ERRO NO BTN STORIES 2')
        # stories
        # time.sleep(120)
        return False
    # enviar mensagem
    time.sleep(5)

    try:
    # Verificar se o elemento com o CSS selector '.wbloks_98' existe
        element = driver.find_element(By.CSS_SELECTOR, ".wbloks_98")
        winsound.Beep(1500, 800) 
        print("Sua conta foi banida")
        update_agente_banido(agente_data['id'], 0)
        return False
    except:
        print("Sua conta não foi banida")

    try:
        possivel_out = driver.find_element(By.CSS_SELECTOR, ".x1dr59a3 > div:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(3) > div:nth-child(2) > a:nth-child(1)")
        possivel_out.click()

        winsound.Beep(1000, 500) 
        winsound.Beep(1000, 500) 
            
        print(" =========== POSSIVELMENTE ERRO NO CADASTRO  =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO")
        update_agente_banido(agente_data['id'], 0)

        return False

    except:
        print('========== foi ========')

    # possivel poupup

    try:
        poupup = driver.find_element(By.CSS_SELECTOR, "button._a9--:nth-child(2)")
        poupup.click()
    except:
         print('   [**] ERRO NO POUPUP')

    # possivel poupup

    time.sleep(5)

    # home
    try:
        btn_home = driver.find_element(By.CSS_SELECTOR, "div.x1iyjqo2:nth-child(2) > div:nth-child(1) > div:nth-child(1) > span:nth-child(1) > div:nth-child(1) > a:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > span:nth-child(1) > span:nth-child(1)")
        btn_home.click()
    except:
        driver.get('https://instagram.com/')
        print('   [**] ERRO NO BTN HOME')
    # home
    time.sleep(5)

     # stories
    try:
        btn_stories = driver.find_element(By.CSS_SELECTOR, ".x17j7krd > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > ul:nth-child(1) > li:nth-child(3) > div:nth-child(1) > button:nth-child(1) > div:nth-child(2) > div:nth-child(1)")
        btn_stories.click()
    except:
        print('   [**] ERRO NO BTN STORIES')
    # stories
    # time.sleep(120)

    try:
    # Verificar se o elemento com o CSS selector '.wbloks_98' existe
        element = driver.find_element(By.CSS_SELECTOR, ".wbloks_98")
        winsound.Beep(1500, 800) 
        print("Sua conta foi banida")
        update_agente_banido(agente_data['id'], 0)
        return False
    except:
        print("Sua conta não foi banida")

    try:
        possivel_out = driver.find_element(By.CSS_SELECTOR, ".x1dr59a3 > div:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(3) > div:nth-child(2) > a:nth-child(1)")
        possivel_out.click()

        winsound.Beep(1000, 500) 
        winsound.Beep(1000, 500) 
            
        print(" =========== POSSIVELMENTE ERRO NO CADASTRO  =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO")
        update_agente_banido(agente_data['id'], 0)

        return False

    except:
        print('========== foi ========')

    
    sleep_time = random.randint(30, 120)  # Gera um número aleatório entre 180 e 360
    print(f"Dormindo por {sleep_time} segundos.")
    time.sleep(sleep_time)  # Faz o programa dormir pelo tempo gerado
      # salvar post main.xvbhtw8 > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > article:nth-child(1) > div:nth-child(1) > div:nth-child(3) > div:nth-child(1) > div:nth-child(1) > section:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1)
    #  like primeiro post main.xvbhtw8 > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > article:nth-child(1) > div:nth-child(1) > div:nth-child(3) > div:nth-child(1) > div:nth-child(1) > section:nth-child(1) > div:nth-child(1) > span:nth-child(1) > div:nth-child(1) > div:nth-child(1)
    # clica no botao reeels 

    try:
    # Verificar se o elemento com o CSS selector '.wbloks_98' existe
        element = driver.find_element(By.CSS_SELECTOR, ".wbloks_98")
        winsound.Beep(1500, 800) 
        print("Sua conta foi banida")
        update_agente_banido(agente_data['id'], 0)
        return False
    except:
        print("Sua conta não foi banida")
    # reels
    try:
        btn_reels = driver.find_element(By.CSS_SELECTOR, ".x1xgvd2v > div:nth-child(2) > div:nth-child(4) > span:nth-child(1) > div:nth-child(1) > a:nth-child(1) > div:nth-child(1)")
        btn_reels.click()
    except:
        print('   [**] ERRO NO BTN REELS')

        try:
            driver.get('https://instagram.com/reels')
        except:
                print('   [**] ERRO NO BTN REELS 2')

    try:
    # Verificar se o elemento com o CSS selector '.wbloks_98' existe
        element = driver.find_element(By.CSS_SELECTOR, ".wbloks_98")
        winsound.Beep(1500, 800) 
        print("Sua conta foi banida")
        update_agente_banido(agente_data['id'], 0)
        return False
    except:
        print("Sua conta não foi banida")

    try:
        possivel_out = driver.find_element(By.CSS_SELECTOR, ".x1dr59a3 > div:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(3) > div:nth-child(2) > a:nth-child(1)")
        possivel_out.click()

        winsound.Beep(1000, 500) 
        winsound.Beep(1000, 500) 
            
        print(" =========== POSSIVELMENTE ERRO NO CADASTRO  =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO")
        update_agente_banido(agente_data['id'], 0)

        return False

    except:
        print('========== foi ========')


    try:
    # Verificar se o elemento com o CSS selector '.wbloks_98' existe
        element = driver.find_element(By.CSS_SELECTOR, ".wbloks_98")
        winsound.Beep(1500, 800) 
        print("Sua conta foi banida")
        update_agente_banido(agente_data['id'], 0)
        return False
    except:
        print("Sua conta não foi banida")

    count = 0
    max_iterations = 5  # Número máximo de vezes que o loop deve rodar

    try:

        while count < max_iterations:
            # Gera um intervalo de tempo aleatório entre 1 e 40 segundos
            wait_time = random.randint(1, 40)
            print(f"Aguardando por {wait_time} segundos...")

            # Espera pelo tempo gerado
            time.sleep(wait_time)

            # 
            try:

                like_reels = driver.find_element(By.CSS_SELECTOR, ".focus-visible")
                like_reels.click()
                
            except:

                print('   [**] ERRO AO CURTIR REELS')

                try:
                    like_reels = driver.find_element(By.CSS_SELECTOR, "div.xg7h5cd:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1)")
                    like_reels.click()
                except:
                    print('   [**] ERRO AO CURTIR REELS DOIS')

               

            # Simula o pressionar da tecla para baixo
            body = driver.find_element(By.TAG_NAME ,'body')
            body.send_keys(Keys.ARROW_DOWN)

            print(f"Pressionando tecla para baixo. Iteração {count + 1}")

            # Incrementa o contador
            count += 1

    except:
        print('    [*] ERRO NO WHILE REELS')

    # Sai do while e continua o código aqui
    print("Loop completado 3 vezes. Continuando o código...")
    # reels

    try:
    # Verificar se o elemento com o CSS selector '.wbloks_98' existe
        element = driver.find_element(By.CSS_SELECTOR, ".wbloks_98")
        winsound.Beep(1500, 800) 
        print("Sua conta foi banida")
        update_agente_banido(agente_data['id'], 0)
        return False
    except:
        print("Sua conta não foi banida")


    return True
    
    # time.sleep(15)

def run_oferta(base_url, agente_data, campanha_data, campanha_ofertas_data, demanda, driver):

    ofertas_pendentes = get_ofertas_pendentes(agente_data['id'])

    # Template de Ofertas
    templates_oferta = get_templates_oferta(base_url, campanha_data['id'])
    template_qtd = len(templates_oferta)
    # Template de Ofertas

    print('\n  []! OFERTAS PENDENTES ENCONTRADAS ', len(ofertas_pendentes))

    if template_qtd > 0:

        # Escolhendo Template
        template_index = random.randint(0, template_qtd - 1)
        template_oferta = templates_oferta[template_index]
        print('\n  [!]  TEMPLATE ESCOLHIDO : '+template_oferta['oferta_nome'])
        # Escolhendo Template

        persona_id = add_persona(agente_data, campanha_data, demanda)
        
        # print('persona id: '+str(persona_id))

        if ofertas_pendentes and len(ofertas_pendentes) > 0: 

            print(' \n  [!] OFERTAS PENDENTES: ', len(ofertas_pendentes))

            oferta_data = ofertas_pendentes[0]


            runof = send_oferta(demanda, template_oferta, campanha_data, agente_data, oferta_data, driver)
            # time.sleep(40)

            if runof:

                update_oferta(oferta_data['id'], 1, demanda['id'])
                pass

            else:

                # print('opdate oferta data ', oferta_data['id'])
                update_oferta_data(oferta_data['id'], demanda['id'])
                # print('[!]')
                pass
            
        else:

            oferta_data = criar_oferta_pendente(agente_data, campanha_data, template_oferta, demanda, persona_id)

            runof = send_oferta(demanda, template_oferta, campanha_data, agente_data, oferta_data, driver)
            # time.sleep(40)

            if runof:

                update_oferta(oferta_data['id'], 1, demanda['id'])
                pass

            else:

                # print('opdate oferta data ', oferta_data['id'])
                update_oferta_data(oferta_data['id'], demanda['id'])
                # print('[!]')
                pass

    else:

        print('\n  [!] Nenhum template disponivel '+campanha_data['campanha_nome']+'\n')
        return False


def open_firefox():

    geckodriver_path = os.path.join(os.getcwd(), 'geckodriver')

    # Cria um novo perfil temporário automaticamente
    profile = webdriver.FirefoxProfile()

    # Define o user agent de um celular Android
    user_agent = "Mozilla/5.0 (Linux; Android 10; SM-G975F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Mobile Safari/537.36"
    profile.set_preference("general.useragent.override", user_agent)

    # Configura o Selenium para usar o Firefox com o perfil temporário
    service = Service(geckodriver_path)
    driver = webdriver.Firefox(service=service, firefox_profile=profile)

    return driver
    
def temp_get_instagram_code(md5):

    conn = http.client.HTTPSConnection("privatix-temp-mail-v1.p.rapidapi.com")

    headers = {
        'x-rapidapi-key': "59676de38dmshc3ef26892aa3735p15c5e7jsn87eb55dc67d4",
        'x-rapidapi-host': "privatix-temp-mail-v1.p.rapidapi.com"
    }

    conn.request("GET", "/request/mail/id/"+str(md5)+"/", headers=headers)

    res = conn.getresponse()
    status = res.status
    data = res.read()

    # Verificar se o status é 200 (sucesso)
    if status == 200:
        # Tentar carregar os dados como JSON
        try:

            json_data = json.loads(data.decode("utf-8"))

            print('EMAIL ENCONTRADOS: ', len(json_data))


            if len(json_data) > 0:
                
                # print(json_data)

                string = json_data[0]['mail_subject']
                print(string)
                code = re.findall(r'\d+', string)
                code = ''.join(code)

                print(code)

                return code

            
            else:
                print('NENHUM E-MAIL CHEGOU')
                return False


            
        
        except json.JSONDecodeError:

            print("Erro ao decodificar a resposta em JSON.")
            
            return False
    else:

        print(f"Erro na requisição. Status: {status}")
        return False

def temp_get_domains():

    conn = http.client.HTTPSConnection("privatix-temp-mail-v1.p.rapidapi.com")

    headers = {
        'x-rapidapi-key': "59676de38dmshc3ef26892aa3735p15c5e7jsn87eb55dc67d4",
        'x-rapidapi-host': "privatix-temp-mail-v1.p.rapidapi.com"
    }

    conn.request("GET", "/request/domains/", headers=headers)

    res = conn.getresponse()
    status = res.status
    data = res.read()

    # Verificar se o status é 200 (sucesso)
    if status == 200:
        # Tentar carregar os dados como JSON
        try:
            json_data = json.loads(data.decode("utf-8"))
            # Verifica se há pelo menos 2 domínios na resposta
            if len(json_data) > 1:
                # Selecionar um índice aleatório entre 1 e o número de domínios
                random_index = random.randint(1, len(json_data) - 1)
                return json_data[random_index]
            else:
                print("Nenhum domínio disponível.")
                return False

        except json.JSONDecodeError:
            print("Erro ao decodificar a resposta em JSON.")
            return False
    else:
        print(f"Erro na requisição. Status: {status}")
        return False

def temp_create_nome():

    # Criar uma instância do Faker para o Brasil
    fake = Faker('pt_BR')

    # Gerar nome e sobrenome aleatórios
    def gerar_nome_brasileiro():
        nome = fake.first_name()  # Nome aleatório
        sobrenome = fake.last_name()  # Sobrenome aleatório
        nome_completo = f"{nome} {sobrenome}"
        return nome_completo

    # Exemplo de uso
    nome_aleatorio = gerar_nome_brasileiro()

    print(f"Nome gerado: {nome_aleatorio}")
    return nome_aleatorio

def get_agente_by_email(base_url, agente_email):

    print('get_agente_by_email', agente_email)

    url = base_url+"get_agente?agente_email="+str(agente_email)+""
    
 
    response = requests.get(url)

    if response.status_code == 200:

        data = json.loads(response.content)
        return data
        
    else:

        return False 
    
def temp_add_agente(base_url, email, email_md5, nome):

    url = base_url+"add_agente?agente_email="+str(email)+"&agente_senha="+str(email_md5)+"&agente_nome="+nome
    
 
    response = requests.get(url)

    if response.status_code == 200:

        data = json.loads(response.content)
        return True
        
    else:

        return False 


# temp_register_agente(driver, email, nome, 'Torio142536*', email_md5)
def temp_register_agente(driver, email, nome, senha, email_md5):

    print('\n == REGISTRANDO AGENTE == \n')

    print('email: ', email)
    print('nome: ', nome)
    print('senha: ', senha)
    print('email_md5: ', email_md5)


    driver.get('https://www.instagram.com/accounts/emailsignup/')

    time.sleep(10)

    try:

        try:
            input_email = driver.find_element(By.CSS_SELECTOR, "div._aahy:nth-child(4) > div:nth-child(1) > label:nth-child(1) > input:nth-child(2)")
            input_email.clear()
            input_email.send_keys(email)
        except:
            print("\n  [*] Falha input_email ")
            return False
        
        time.sleep(3)
        
        try:
            input_nome = driver.find_element(By.CSS_SELECTOR, "div._aahy:nth-child(6) > div:nth-child(1) > label:nth-child(1) > input:nth-child(2)")
            input_nome.clear()
            input_nome.send_keys(nome)
        except:
            print("\n  [*] Falha input_nome ")
            return False
        
        time.sleep(3)

        try:
            input_username_sugestao = driver.find_element(By.CSS_SELECTOR, "div.x1i10hfl")
            input_username_sugestao.click()

        except:

            print("\n  [*] Falha input_username_sugestao ")

            try:

                random_name = ''.join(random.choices('0ABCDEFGHIJKLMNOPQRSTUVWXYZ543216789', k=7))

                input_username = driver.find_element(By.CSS_SELECTOR, "div._aahy:nth-child(6) > div:nth-child(1) > label:nth-child(1) > input:nth-child(2)")
                input_username.clear()
                input_username.send_keys(random_name)

            except:

                print("\n  [*] Falha input_username ")
                return False
            
        time.sleep(3)

        try:

            input_senha = driver.find_element(By.CSS_SELECTOR, "div._aahy:nth-child(5) > div:nth-child(1) > label:nth-child(1) > input:nth-child(2)")
            input_senha.clear()
            input_senha.send_keys(senha)

        except:

            print("\n  [*] Falha input_senha ")

            try:
                input_senhax = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/div/div/div[1]/div[1]/div/section/main/div/div/div[1]/div[2]/div/form/div[8]/div/label/input")
                input_senhax.clear()
                input_senhax.send_keys(senha)

            except:

                print("\n  [*] Falha input_senha 2 ")
                return False
                    
        time.sleep(3)
        
        try:
            btn_cadastro = driver.find_element(By.CSS_SELECTOR, "div.x1xmf6yo:nth-child(1) > button:nth-child(1)")
            btn_cadastro.click()
        except:

            print("\n  [*] Falha btn_cadastro")
            return False
        
        time.sleep(10)
        
        print('\n == DEFININDO DATA  == \n')

        try:

            select_mes = driver.find_element(By.CSS_SELECTOR, "span._aav3:nth-child(1) > select:nth-child(2)")
            select_mesx = Select(select_mes)
            select_mesx.select_by_index(3) 

        except:
    
            print("\n  [*] Falha select_mes")
            return False
        
        time.sleep(3)
        
        try:

            selectdia = driver.find_element(By.CSS_SELECTOR, "span._aav3:nth-child(2) > select:nth-child(2)")
            selectdiax = Select(selectdia)
            selectdiax.select_by_index(23) 

        except:

            print("\n  [*] Falha selectdia")
            return False
        
        time.sleep(3)
        
        
        try:

            select_ano = driver.find_element(By.CSS_SELECTOR, "span._aav3:nth-child(3) > select:nth-child(2)")
            select_anox = Select(select_ano)
            select_anox.select_by_index(26) 

        except:
            print("\n  [*] Falha select_ano")
            return False
        
        time.sleep(3)        
        
        try:

            btn_next = driver.find_element(By.CSS_SELECTOR, "._acap")
            btn_next.click()

        except:
          
            print("\n  [*] Falha btn_next")
            return False
        
        time.sleep(3)
        
        
        print('\n == RECEBENDO CÓDIGO  == \n')

        insta_code = ""

        count_abcx = 0

        try:
            while True:

                try:

                    code = temp_get_instagram_code(email_md5)  # Chama a função

                    if code:  # Se não for False, encerra o loop

                        insta_code = code

                        break

                    
                    count_abcx += 1

                    print('  [!] Tentativa: ', count_abcx)

                    if int(count_abcx) == 10:

                        print('Já tentou '+str(count_abcx)+' vezes. ')
                        return False


                    print('Aguardando  10 segundos.')

                    time.sleep(10)  # Espera 10 segundos antes de tentar novamente
                    
                except Exception as e:

                    print(f'ERRO while: {str(e)}')

                    print('Aguardando  10 segundos.')

                    print('  [!] Tentativa: ', count_abcx)

                    count_abcx += 1

                    print('  [!] Tentativa: ', count_abcx)

                    if int(count_abcx) == 10:

                        print('Já tentou '+str(count_abcx)+' vezes. ')
                        return False
                    
                    time.sleep(10)  # Espera 10 segundos antes de tentar novamente
                    # return False

        except Exception as e:
            print(f'ERRO while: {str(e)}')
            return False
        
        time.sleep(3)
        
        try:

            input_code = driver.find_element(By.CSS_SELECTOR, "._aaie")
            input_code.clear()
            input_code.send_keys(insta_code)

        except:

            print("\n  [*] Falha inpu_code")

            try:

                input_code = driver.find_element(By.CSS_SELECTOR, "/html/body/div[2]/div/div/div[2]/div/div/div[1]/div[1]/div/section/main/div/div/div[1]/div/div[2]/form/div/div[1]/input")
                input_code.clear()
                input_code.send_keys(insta_code)

            except:

                print("\n  [*] Falha inpu_code 2")
                
                return False

        time.sleep(3)
        
        try:

            btn_cadastro_code = driver.find_element(By.CSS_SELECTOR, ".x1lq5wgf")
            btn_cadastro_code.click()

        except:

            print("\n  [*] Falha btn_cadastro_code")

            return False
        
        # sndanien@cpav3.com
        time.sleep(30)


        # try:

        #     check_erro_cadastro = driver.find_element(By.CSS_SELECTOR, ".x1lq5wgf")

        # except:

        #     print("\n  [*] Falha erro adicionar codigo e criar conta")

        #     return False


        # possivel poupup
        try:
            poupup = driver.find_element(By.CSS_SELECTOR, "button._a9--:nth-child(2)")
            poupup.click()
        except:
            print("\n  [*] Falha POUPUP")

        # possivel poupup

        try:

            btn_suggest = driver.find_element(By.CSS_SELECTOR, "div.x1i10hfl")
            btn_suggest.click()

        except:

            print("\n  [*] Falha btn_suggest")
            # return False


        try:
            possivel_out = driver.find_element(By.CSS_SELECTOR, ".x1dr59a3 > div:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(3) > div:nth-child(2) > a:nth-child(1)")
            possivel_out.click()

            winsound.Beep(1000, 500) 
            winsound.Beep(1000, 500) 
            
            print(" =========== POSSIVELMENTE ERRO NO CADASTRO  =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO =========== POSSIVELMENTE ERRO NO CADASTRO")
            
            return False

        except:

            print('\n  [!] Aparentemente tudo certo. \n')
            

        return True

    except:

        return False

def temp_create_agente(driver):

    demain = temp_get_domains()

    if demain:

        nome = temp_create_nome()

        nome_split = nome.split(' ')
        nome_split = re.sub(r'[^a-zA-Z0-9_]', '', nome_split[0])


        # Gerar nome aleatório de 7 dígitos
        random_name = ''.join(random.choices('0123456789', k=5))
        raw_name = nome_split + random_name
        clean_name = re.sub(r'[^a-zA-Z0-9_]', '', raw_name)

        clean_name = clean_name.lower()
        
        email = f"{clean_name}{demain}"

        print(f"\n  [!] Email gerado: {email}")

        # Converter o email para MD5
        email_md5 = hashlib.md5(email.encode()).hexdigest()
        print(f"\n  [!] MD5 Hash: {email_md5}")

        if temp_add_agente(base_url, email, email_md5, nome):

            register = temp_register_agente(driver, email, nome, 'Torio142536@', email_md5)

            if register:

                return email
            
            else :

                print("\n  [*] Falha temp_register_agente ")
                return False
        else:

            print("\n  [*] Falha temp_add_agente ")
            return False

    else:
     
        print("\n  [*] Falha temp_get_domains ")
        return False

def choose_campaign():

    # Escolhe o tipo de campanha
    
    campanha_style = input('\n [!] OPÇÃO DE CAMPANHA [!] \n\n Para selecionar uma campanha especifica \n Digite 1 \n Para uma campanha aleatoria \n Digite 2 \n\n [!] Digite a opção desejada: ')

    if int(campanha_style) == 1 or int(campanha_style) ==2 :

        print('\n  [!] Opção escolhida: '+ campanha_style)

        if int(campanha_style) == 1:

            print("\n ===== SELECIONE A CAMPANHA DESEJADA ==== \n")

            campanhas_ativas = get_campanhas_ativas(base_url)

            for c in campanhas_ativas:
                print(f"[{c['id']}] - {c['campanha_nome']}")

            c_id = input('\n  [!] Digite o ID da campanha desejada: ')

            try:
                c_id = int(c_id)  # Converte a entrada para inteiro
            except ValueError:
                print("ID inválido. O ID deve ser um número.")
                sys.exit()

            # Verifica se o ID existe nas campanhas ativas
            campanha_data = False

            for campanha in campanhas_ativas:
                if int(campanha['id']) == c_id:
                    campanha_data = campanha
                    break

            if campanha_data:

                print(f"\n ===  [!] CAMPANHA SELECIONADA: #{campanha_data['id']} {campanha_data['campanha_nome']} === \n")
                return campanha_data

            else:

                print(f"\n  [!] Campanha com o ID {c_id} não encontrada.")
                sys.exit()

    
        elif int(campanha_style) == 2:

            campanhas_ativas = get_campanhas_ativas(base_url)

            if len(campanhas_ativas) > 0:

                
                campanha_data = campanhas_ativas[0]

                if campanha_data:

                    print(f"\n ===  [!] CAMPANHA SELECIONADA: #{campanha_data['id']} {campanha_data['campanha_nome']} === \n")

                    return campanha_data
                
                else:

                    return False

            else:

                print('\n  [*] Não existem campanhas ativas.')
                sys.exit()

        return campanha_data
        
    else:
        
        print('\n  [*] Voce escolheu uma opção existente. Voce sabe ler?')
        sys.exit()

if __name__ == "__main__":

    firefox_driver_status = False
    agent_logged = False

    base_url = "https://ccoanalitica.com/torio/api/torio/"

    # Escolhe o tipo de campanha
    campanha_data = choose_campaign()

    if campanha_data:

        demandas_pendentes = get_demandas_por_campanha(base_url, campanha_data['id'])

        if demandas_pendentes and len(demandas_pendentes) > 0:

            print(f'\n  [!] Demandas Encontradas: {len(demandas_pendentes)}\n')


            d_count = 0

            for demanda in demandas_pendentes:

                headers = {
                    'Accept': '*/*',
                    'Accept-Encoding': 'gzip, deflate, br',
                    'Accept-Language': 'pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
                    # 'Cookie': self.header_data[self.header_current]['agente_cookie'],
                    'Cookie': 'ig_did=1E36CBE8-F02A-49AA-BD2B-E1A5C0111ED0; datr=i-UrZsTnMEkNQqCkeoO2UKJu; ig_nrcb=1; fbm_124024574287414=base_domain=.instagram.com; ps_n=1; ps_l=1; mid=Zm4XgQALAAEMoTlQzk2A2V8ajQLo; ds_user_id=61013886138; csrftoken=rhPONWnbfDRydarqzs9IbIvfG8aQvmWt; fbsr_124024574287414=Pk60WKWC-eWKho4L43cKlid1JTngVaObISl_RQTXWPk.eyJ1c2VyX2lkIjoiMTAwMDg5NDAyNTYzMTE3IiwiY29kZSI6IkFRQlNEZkVCTUdlZ0xROW1aSUFOSnBpbFFGTGQzeEY4Z2lOTHBEd2VBVmVOUXo1czVTeU13UzBkMUtqeXh2NnQySmtSSTExTG5ORGlYUGJzU3dyYWplZHVDa2JsYjdqN0hldVNYMXRDNnc2NEhqWlZnNTByWm1Lb1dWZkFrSGRIWjFkSHRPbmVjejlwMFJ4ektmckh3M1FTV2hCeFh4UkhFTlpEYVl1TFlfQ2ZLS09kTEs0dmEyUXE1QTBtUXlrZkVoT3lPWWhDS1c4aUVSdW5vdUFGdkplY2Z1MXdoNUlIa0hSdFVlVllxQkNZNmc5aTVfa1RvOWtFRDQ1QXRIS005TlhHVHJDWV9HVVhUMlZPa1oyRGR5Z1Etc1dacGpiRWJaRm00TXRnZGlOY3o3RTFWRE91OTFMcUdXQV9Oa21tTF8ySi1VNDNiS2Z3ZUZON0dQRVJQNHVCVERfTFBFNkpRRE5hS2VyMTdSbW53QSIsIm9hdXRoX3Rva2VuIjoiRUFBQnd6TGl4bmpZQk93UjV5TlpCbFBteVByNWdZV0tIRjNaQ1dzV2MxcE1rdHpwaFpBYzZyMlBvZkVSdXgyajRSbHllVUJNMHBQR3N0N0sxUlpBckJhYmY5WkI4aEcxNjBodE9zUm5GTVVoaXcxcWlVZ0tSV2dFb09JdnQwYXBkWkF4bXRPRzB0N2ZxeHFsYTFINGFhc2hGaDZEcE1VRnQ3WkJjcTJzNXJZSzk5VjRCTlJ5Y3ZUTnRaQ1A1a2hNWkFiS0dsQ2RZWkQiLCJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImlzc3VlZF9hdCI6MTcyNzExMDE1N30; shbid="7447\05461013886138\0541759206120:01f7d546c8dab3869ffc30ad366f892fd6ae6ffca2dedbf5322db2116b287942a307dfe1"; shbts="1727670120\05461013886138\0541759206120:01f7864205e1bc876bf28dc6fa151a35a67a0cc0d389702579f84f8bc99f23b621971aa3"; sessionid=61013886138%3A4hY4q8IsFe1IOi%3A6%3AAYdT8Y9-geh8GaEQgyrehAm_lyMKH1LjGaxrkomdHl8; wd=1312x308; rur="NHA\05461013886138\0541759256930:01f7c13d17bf6e00c0ed56eefe4c6ec6bcb301e3466e5169299b37b270927d945953d0c4"',
                    'Dpr': '1',
                    'Referer': 'https://www.instagram.com/p/C07F4jjrEy2/?img_index=1',
                    'Sec-Ch-Prefers-Color-Scheme': 'light',
                    'Sec-Ch-Ua': '"Opera";v="105", "Chromium";v="119", "Not?A_Brand";v="24"',
                    'Sec-Ch-Ua-Full-Version-List': '"Opera";v="105.0.4970.60", "Chromium";v="119.0.6045.199", "Not?A_Brand";v="24.0.0.0"',
                    'Sec-Ch-Ua-Mobile': '?0',
                    'Sec-Ch-Ua-Model': '""',
                    'Sec-Ch-Ua-Platform': '"Windows"',
                    'Sec-Ch-Ua-Platform-Version': '"10.0.0"',
                    'Sec-Fetch-Dest': 'empty',
                    'Sec-Fetch-Mode': 'cors',
                    'Sec-Fetch-Site': 'same-origin',
                    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 OPR/105.0.0.0',
                    'Viewport-Width': '1312',
                    'X-Asbd-Id': '129477',
                    # 'X-Csrftoken': self.header_data[self.header_current]['agente_crsf'],
                    'X-Csrftoken': 'rhPONWnbfDRydarqzs9IbIvfG8aQvmWt',
                    'X-Ig-App-Id': '936619743392459',
                    'X-Ig-Www-Claim': 'hmac.AR2kovJ4-DcOAF0d43NiUcqAx69DUcqPe2rRZLMjoHsdi9v6',
                    'X-Requested-With': 'XMLHttpRequest'
                }
    

                url = 'https://www.instagram.com/api/v1/users/web_profile_info/?username='+demanda['username']
                print(url)
                response = requests.get(url, headers=headers)

                try:
                    
                    if response.status_code == 200:

                        user_data = ""

                        try:
                        
                            user_data = json.loads(response.content)

                            d_count = d_count + 1

                            print("CONTAGEM: "+str(d_count))

                            # print(user_data)


                        except Exception as e:
                            print('Erro do JSON ', e)

        
                        # ===================

                        print('\n ==================>> ACESSANDO: '+demanda['username']+'\n\n')
                               
                        # Links
                        links = ""
                                
                        try:

                            for link in user_data['data']['user']['bio_links']:
                                        
                                if links:  # Verifica se a string já possui conteúdo
                                    links += ", " + link['url']  # Adiciona o link à string, separado por vírgula
                                else:
                                    links += link['url']

                        except Exception as e:
                                    # print('[**] Erro ao capturar links:', e)
                            pass

                        mencoes= ""
                                
                        try:
                            for mencao in user_data['data']['user']['biography_with_entities']['entities']:
                                if mencoes:  # Verifica se a string já possui conteúdo
                                    mencoes += ", " + mencao['user']['username']  # Adiciona a menção à string, separada por vírgula
                                else:
                                    mencoes += mencao['user']['username']
                        except Exception as e:
                            pass

                        persona = {
                                        'username': user_data['data']['user']['username'],
                                        'full_name': user_data['data']['user']['full_name'],
                                        'is_private': user_data['data']['user']['is_private'],
                                        'biografia': user_data['data']['user']['biography'],
                                        'links': links,
                                        'mencoes': mencoes,
                                        'categoria': user_data['data']['user']['category_name'],
                                        # 'email': extractEmail(user_data['data']['user']['business_email'], user_data['data']['user']['biography'], links, headers, mencoes),
                                        # 'telefone': extractTelefone(user_data['data']['user']['business_phone_number'], links, user_data['data']['user']['biography'], mencoes, headers),
                                       
                        }

                        print('\n====')
                        print(persona)
                        print('\n====')

                        # ==========

                    elif response.status_code == 404:

                        print('None 404')                    

                    elif response.status_code == 429:

                        print("=========== GET PROFILE LIMIT REACH :"+ str(response.status_code))
                        print('False 429')

                    else:

                        print("=========== NEW FAILED RESPONSE :"+ str(response.status_code))
                        print('False')


                except Exception as e:
                    
                    print("=========== GET PROFILE EXCEPTION: ", e)
             
                    
                time.sleep(10)

        else:
            print('\n  [*] Falha ao pegar demandas OU zero demandas foram encontradas. \n')
            sys.exit()    
    else:
        print('\n  [*] Falha ao selecionar campanha \n')
        sys.exit()

        

   