# proxima melhoria
# colocar update_oferta(oferta_data['id'], 1, demanda['id']) 
# logo após input de enviar mensagem pra evitar possiveis erros e deixar a demanda como nao-processada

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

def setup_selenium_firefox():
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
   
    # ==================================

  
    time.sleep(10)

    # acessando perfil
    driver.get('https://instagram.com/'+demanda['username'])

    print('    [**] PROCESSANDO DEMANDA: '+demanda['username'])

    # driver.get('https://www.instagram.com/fabiolamelooficial/')
    # acessando perfil

    time.sleep(10)
    # # search button
    # try:

    #     search_button = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div/div[2]/div/div/div[1]/div[1]/div[2]/div/div/div/div/div[2]/div[2]/span/div/a")
    #     search_button.click()

    # except:
    #     print('   [***] PROVAVELMENTE NÃO LOGOU '+agente_data['agente_nome'])
    #     return False
    # # search button

    # time.sleep(5)

    #  # input_search
    # input_search = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div/div[2]/div/div/div[1]/div[1]/div[2]/div/div/div[2]/div/div/div[2]/div/div/div[1]/div/div/input")
    # input_search.clear()  # Limpa o campo de texto, caso haja algum valor anterior
    # input_search.send_keys(demanda['username'])  # Insere o valor no campo de input
    # # input_search

    # time.sleep(5)

    # # click result
    # click_result = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div/div[2]/div/div/div[1]/div[1]/div[2]/div/div/div[2]/div/div/div[2]/div/div/div[2]/div/a")
    # click_result.click()
    # # click result

    # time.sleep(5)

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
                btn_stories_dois = driver.find_element(By.CSS_SELECTOR, ".x1hq5gj4 > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > ul:nth-child(1) > li:nth-child(3) > div:nth-child(1) > button:nth-child(1) > div:nth-child(1)")
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

    
    time.sleep(120)
      # salvar post main.xvbhtw8 > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > article:nth-child(1) > div:nth-child(1) > div:nth-child(3) > div:nth-child(1) > div:nth-child(1) > section:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1)
    #  like primeiro post main.xvbhtw8 > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > article:nth-child(1) > div:nth-child(1) > div:nth-child(3) > div:nth-child(1) > div:nth-child(1) > section:nth-child(1) > div:nth-child(1) > span:nth-child(1) > div:nth-child(1) > div:nth-child(1)
    # clica no botao reeels 
    # stories
    try:
        btn_reels = driver.find_element(By.CSS_SELECTOR, ".x1xgvd2v > div:nth-child(2) > div:nth-child(4) > span:nth-child(1) > div:nth-child(1) > a:nth-child(1) > div:nth-child(1)")
        btn_reels.click()
    except:
        print('   [**] ERRO NO BTN REELS')

        try:
            driver.get('https://instagram.com/reels')
        except:
                print('   [**] ERRO NO BTN REELS 2')

    count = 0
    max_iterations = 3  # Número máximo de vezes que o loop deve rodar

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
    # stories


    return True
    
    # time.sleep(15)

def run_oferta(base_url, agente_data, campanha_data, campanha_ofertas_data, demanda, driver):

    ofertas_pendentes = get_ofertas_pendentes(agente_data['id'])

    # Template de Ofertas
    templates_oferta = get_templates_oferta(base_url, campanha_data['id'])
    template_qtd = len(templates_oferta)
    # Template de Ofertas

    print('OFERTAS PENDENTES ENCONTRADAS ', len(ofertas_pendentes))

    if template_qtd > 0:

        # Escolhendo Template
        template_index = random.randint(0, template_qtd - 1)
        template_oferta = templates_oferta[template_index]
        print('      [!]  TEMPLATE ESCOLHIDO : '+template_oferta['oferta_nome'])
        # Escolhendo Template

        persona_id = add_persona(agente_data, campanha_data, demanda)
        
        # print('persona id: '+str(persona_id))



        if ofertas_pendentes and len(ofertas_pendentes) > 0: 

            print('      [*****] OFERTAS PENDENTES: ', len(ofertas_pendentes))

            oferta_data = ofertas_pendentes[0]


            runof = send_oferta(demanda, template_oferta, campanha_data, agente_data, oferta_data, driver)
            time.sleep(40)

            if runof:

                update_oferta(oferta_data['id'], 1, demanda['id'])
                pass

            else:

                print('opdate oferta data ', oferta_data['id'])
                update_oferta_data(oferta_data['id'], demanda['id'])
                # print('[!]')
                pass
            
        else:

            oferta_data = criar_oferta_pendente(agente_data, campanha_data, template_oferta, demanda, persona_id)

            runof = send_oferta(demanda, template_oferta, campanha_data, agente_data, oferta_data, driver)
            time.sleep(40)

            if runof:

                update_oferta(oferta_data['id'], 1, demanda['id'])
                pass

            else:

                print('opdate oferta data ', oferta_data['id'])
                update_oferta_data(oferta_data['id'], demanda['id'])
                # print('[!]')
                pass

    else:

        print('  [!] NENHUM OFERTA DISPONÍVEL NA CAMPANHA : '+campanha_data['campanha_nome'])

def setup_selenium_firefox():

    geckodriver_path = os.path.join(os.getcwd(), 'geckodriver')

    # Cria um novo perfil temporário automaticamente
    profile = webdriver.FirefoxProfile()

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
                
                print(json_data)

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
            return json_data[1]
        
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

def temp_register_agente(driver, email, nome, senha, email_md5):

    driver.get('https://www.instagram.com/accounts/emailsignup/')

    time.sleep(10)

    try:

        try:
            input_email = driver.find_element(By.CSS_SELECTOR, "div._aahy:nth-child(4) > div:nth-child(1) > label:nth-child(1) > input:nth-child(2)")
            input_email.clear()
            input_email.send_keys(email)
        except:
            print('FALHA input_email ')
            return False
        
        time.sleep(5)
        
        try:
            input_nome = driver.find_element(By.CSS_SELECTOR, "div._aahy:nth-child(5) > div:nth-child(1) > label:nth-child(1) > input:nth-child(2)")
            input_nome.clear()
            input_nome.send_keys(nome)
        except:
            print('FALHA input_nome ')
            return False
        
        time.sleep(5)

        try:
            input_username_sugestao = driver.find_element(By.CSS_SELECTOR, "div.x1i10hfl")
            input_username_sugestao.click()
        except:

            print('FALHA input_username_sugestao ')

            try:

                random_name = ''.join(random.choices('0ABCDEFGHIJKLMNOPQRSTUVWXYZ543216789', k=7))

                input_username = driver.find_element(By.CSS_SELECTOR, "div._aahy:nth-child(6) > div:nth-child(1) > label:nth-child(1) > input:nth-child(2)")
                input_username.clear()
                input_username.send_keys(random_name)

            except:
                print('FALHA input_username ')
                return False
            
        time.sleep(5)

        try:

            input_senha = driver.find_element(By.CSS_SELECTOR, "div._aahy:nth-child(8) > div:nth-child(1) > label:nth-child(1) > input:nth-child(2)")
            input_senha.clear()
            input_senha.send_keys(senha)

        except:
            print('FALHA input_senha ')

            try:
                input_senhax = driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/div/div/div[1]/div[1]/div/section/main/div/div/div[1]/div[2]/div/form/div[8]/div/label/input")
                input_senhax.clear()
                input_senhax.send_keys(senha)

            except:

                print('FALHA input_senha 2 ')
                return False
                    
        time.sleep(5)
        
        try:
            btn_cadastro = driver.find_element(By.CSS_SELECTOR, "div.x1xmf6yo:nth-child(1) > button:nth-child(1)")
            btn_cadastro.click()
        except:
            print('FALHA btn_cadastro ')
            return False
        
        time.sleep(5)
        
        # ========================

        try:

            select_mes = driver.find_element(By.CSS_SELECTOR, "span._aav3:nth-child(1) > select:nth-child(2)")
            select_mesx = Select(select_mes)
            select_mesx.select_by_index(2) 

        except:
            print('FALHA select_mes')
            return False
        
        time.sleep(5)
        
        try:

            selectdia = driver.find_element(By.CSS_SELECTOR, "span._aav3:nth-child(2) > select:nth-child(2)")
            selectdiax = Select(selectdia)
            selectdiax.select_by_index(22) 

        except:
            print('FALHA selectdia')
            return False
        
        time.sleep(5)
        
        
        try:

            select_ano = driver.find_element(By.CSS_SELECTOR, "span._aav3:nth-child(3) > select:nth-child(2)")
            select_anox = Select(select_ano)
            select_anox.select_by_index(25) 

        except:
            print('FALHA select_ano')
            return False
        
        time.sleep(5)
        
        
        try:

            btn_next = driver.find_element(By.CSS_SELECTOR, "._acap")
            btn_next.click()

        except:
            print('FALHA btn_next')
            return False
        
        time.sleep(5)
        
        
        # =============================

        insta_code = ""

        try:
            while True:

                try:
                    code = temp_get_instagram_code(email_md5)  # Chama a função
                    if code:  # Se não for False, encerra o loop

                        insta_code = code

                        break

                    print('Aguardando  10 segundos.')
                    time.sleep(10)  # Espera 10 segundos antes de tentar novamente
                    
                except Exception as e:
                    print(f'ERRO while: {str(e)}')
                    print('Aguardando  10 segundos.')
                    time.sleep(10)  # Espera 10 segundos antes de tentar novamente
                    return False

        except Exception as e:
            print(f'ERRO while: {str(e)}')
            return False
        
        time.sleep(5)
        
        try:

            input_code = driver.find_element(By.CSS_SELECTOR, "._aaie")
            input_code.clear()
            input_code.send_keys(insta_code)

        except:

            print('FALHA inpu_code')

            try:

                input_code = driver.find_element(By.CSS_SELECTOR, "/html/body/div[2]/div/div/div[2]/div/div/div[1]/div[1]/div/section/main/div/div/div[1]/div/div[2]/form/div/div[1]/input")
                input_code.clear()
                input_code.send_keys(insta_code)

            except:

                print('FALHA inpu_code 2')
                
                return False

        time.sleep(5)
        
        try:

            btn_cadastro_code = driver.find_element(By.CSS_SELECTOR, ".x1lq5wgf")
            btn_cadastro_code.click()

        except:
            print('FALHA btn_cadastro_code')
            return False
        
        # sndanien@cpav3.com
        time.sleep(30)

        # possivel poupup
        try:
            poupup = driver.find_element(By.CSS_SELECTOR, "button._a9--:nth-child(2)")
            poupup.click()
        except:
            print('   [**] ERRO NO POUPUP')

        # possivel poupup

        try:

            btn_suggest = driver.find_element(By.CSS_SELECTOR, "div.x1i10hfl")
            btn_suggest.click()

        except:
            print('FALHA btn_suggest')
            # return False


        return True

    except:

        return False


def temp_create_agente(driver):

    demain = temp_get_domains()

    if demain:

        # Gerar nome aleatório de 7 dígitos
        random_name = ''.join(random.choices('0123456789', k=7))
        email = f"{random_name}{demain}"
        print(f"Email gerado: {email}")

        # Converter o email para MD5
        email_md5 = hashlib.md5(email.encode()).hexdigest()
        print(f"MD5 Hash: {email_md5}")

        nome = temp_create_nome()

        if temp_add_agente(base_url, email, email_md5, nome):

            register = temp_register_agente(driver, email, nome, 'Torio142536*', email_md5)

            if register:

                return email
            
            else :

                print('FAIL: temp_register_agente')
        else:

            print('FAIL: temp_add_agente')
            return False

    else:
        print('FAIL: temp_get_domains')
        return False


if __name__ == "__main__":

    driverx = False

    base_url = "https://ccoanalitica.com/torio/api/torio/"

    try:

        driver = setup_selenium_firefox()
        driverx = True

    except:
        print('PROBLEMA AO ABRIR NAVEGADOR')


    # get campanhas ativas
    campanhas_ativas = get_campanhas_ativas(base_url)

    if len(campanhas_ativas) > 0:

        for campanha_data in campanhas_ativas:

            print('[!] TOTAL DE CAMPANHAS ATIVAS: ', len(campanhas_ativas))

            # Pegando ofertas da campanha
            campanha_ofertas_data = get_campanha_ofertas(campanha_data['id'])

            print(' [!] CAMPANHA ATUAL: ', campanha_data['campanha_nome'])


            demandas_pendentes = get_demandas_por_campanha(base_url, campanha_data['id'])

            print('  [!] DEMANDAS PENDENTES: ', len(demandas_pendentes))


            logged = False

            if len(demandas_pendentes) > 0 :

                for demanda in demandas_pendentes:

                    if logged == False:

                        print('  [!] CRIANDO NOVO AGENTE')
                        agente_create = temp_create_agente(driver)

                    if agente_create:

                        logged = True

                        agente_data = get_agente_by_email(base_url, agente_create)
                        agente_ofertas = len(count_agentes_oferta(agente_data['id']))

                        if (len(agente_data) > 0 ):

                            if (agente_ofertas < 50):

                                print('  [!] '+agente_data['agente_email']+'JÁ REALIZOU '+str(agente_ofertas)+' PROPOSTAS')

                                update_agente_ocupado(agente_data['id'], 1)

                                run_oferta(base_url, agente_data, campanha_data, campanha_ofertas_data, demanda, driver)

                            else:

                                print('  [!] '+agente_data['agente_email']+' ATINGIU O LIMITE DE 50 PROPOSTAS')
                                winsound.Beep(1000, 500)  

                                update_agente_ocupado(agente_data['id'], 0)

                                logged = False

                        else:

                            print('  [!] NENHUM AGENTE DISPONÍVEL NO MOMENTO - STEP 1 ** ESPERANDO 10 MINUTOS')
                            time.sleep(600)

                        time.sleep(3)

                    time.sleep(30)
            else:

                print('   [!] NÃO EXISTEM DEMANDAS PENDENTES: ', len(demandas_pendentes))
            
            time.sleep(10)

    else:

        print('[!] NÃO EXISTEM CAMPANHAS ATIVAS.')

    
    # Abre uma página para testar
    # driver.get("https://www.instagram.com")
    # print(driver.title)
    
    # # Fecha o navegador
    # driver.quit()


# 