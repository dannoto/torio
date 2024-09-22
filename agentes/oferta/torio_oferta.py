import requests
import tarfile
import os
import platform
from selenium import webdriver
from selenium.webdriver.firefox.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys

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

    # ocupando agente

    update_agente_ocupado(agente_data['id'], 1)

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

    print('UPDATE AGENTE: ', agente_id)

    url = base_url+"/update_agente_ocupado?agente_id="+str(agente_id)+"&agente_ocupado="+str(agente_ocupado)+""
    print(url)        
    response = requests.get(url)

    if response.status_code == 200:
            
        data = json.loads(response.content)
   
        return data
        
    else:

        return False 

def update_oferta(oferta_id, oferta_status, demanda_id) :
       
    url = base_url+"/update_oferta?oferta_id="+str(oferta_id)+"&oferta_status="+str(oferta_status)+"&demanda_id="+str(demanda_id)+""
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
        # stories
        # time.sleep(120)
        return False
    # btn clicar input

    time.sleep(5)

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
            time.sleep(120)

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
            time.sleep(120)

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

if __name__ == "__main__":

    driverx = False

    base_url = "https://ccoanalitica.com/torio/api/torio/"

    try:

        setup_selenium_firefox()

        # Encontra o caminho do geckodriver
        geckodriver_path = os.path.join(os.getcwd(), 'geckodriver')
        
        # Configura o Selenium para usar o Firefox
        service = Service(geckodriver_path)
        driver = webdriver.Firefox(service=service)

        driverx = True

    except:
        print('PROBLEMA AO ABRIR NAVEGADOR')


    # get campanhas ativas
    campanhas_ativas = get_campanhas_ativas(base_url)

    if len(campanhas_ativas) > 0:

        for campanha_data in campanhas_ativas:

            # Pegando ofertas da campanha
            campanha_ofertas_data = get_campanha_ofertas(campanha_data['id'])
            
            print('[!] CAMPANHAS ATIVAS: ', len(campanhas_ativas))

            demandas_pendentes = get_demandas_por_campanha(base_url, campanha_data['id'])

            print('[!] [ '+campanha_data['campanha_nome']+' ] DEMANDAS PENDENTES: ', len(demandas_pendentes))

            if len(demandas_pendentes) > 0 :

                agente_index = 0
                logged = False

                for demanda in demandas_pendentes:


                    # {'id': '35207', 'tarefa_id': '92', 'tag_id': '20', 'username': 'dgzinxz.wz', 'is_private': 'False', 'full_name': 'dgzinn', 'interacao_tipo': 'like', 'interacao_conteudo': '', 'interacao_data': '2024-07-23 11:19:41', 'post_id': '3418558052924988026', 'post_slug': 'C9xKG_UpRp6', 'post_data': '2024-07-23 11:19:41', 'post_descricao': 'Canta essa comigo? \nQue Ruja o Leão ???? ❤️\u200d???? \n\n#louvor #brasil #bomdia #boanoite #god #vida #jesus #musica #paz #church #cover #deus #deusnocomando #worship #gospel #biblia #igreja #jesuscristo #espiritosanto #cristo #deusnocontrole #miriansilva', 'post_imagem': 'https://instagram.fgyn18-1.fna.fbcdn.net/v/t51.29350-15/452644869_3796491517337562_8303082051071527339_n.jpg?stp=dst-jpg_e15&amp;efg=eyJ2ZW5jb2RlX3RhZyI6ImltYWdlX3VybGdlbi41NzR4MTAyMC5zZHIuZjI5MzUwLmRlZmF1bHRfY292ZXJfZnJhbWUifQ&amp;_nc_ht=instagram.fgyn18-1.fna.fbcdn.net&amp;_nc_cat=106&amp;_nc_ohc=JV-mvRsBk6IQ7kNvgGpAtaR&amp;edm=ALQROFkBAAAA&amp;ccb=7-5&amp;ig_cache_key=MzQxODU1ODA1MjkyNDk4ODAyNg%3D%3D.3-ccb7-5&amp;oh=00_AYBIjRROhlerBCAz_l6t2CqjxAtYW1A8-iuEVy9Zcy_ZMg&amp;oe=66E6DD70&amp;_nc_sid=fc8dfb', 'processado': '0', 'is_deleted': '0'}
                    agentes_data = get_agentes(base_url)
                    agente_data = agentes_data[agente_index]
                    agente_ofertas = len(count_agentes_oferta(agente_data['id']))

                    
                    

                    if (len(agente_data) > 0 ):

                        if (agente_ofertas < 30):

                            

                            print('  [!] NOVO AGENTE [ '+agente_data['agente_nome']+' ] JÁ REALIZOU '+str(agente_ofertas)+' OFERTAS HOJE')

                            # Logando

                            if logged == False:
                                logged = login(driver, agente_data, demanda)
                            else:
                                print('JÁ ESTÁ LOGADO')

                            # Logando

                            run_oferta(base_url, agente_data, campanha_data, campanha_ofertas_data, demanda, driver)

                        else:

                            print('  [!] AGENTE [ '+agente_data['agente_nome']+' ] AINGITIU O LIMITE DIÁRIO 30')
                            agentes_qtd = len(agentes_data)
                            print('  TOTAL AGENTES LIVRES: ', agentes_qtd)

                            update_agente_ocupado(agente_data['id'], 0)


                            # Deslogando
                            driverx = False
                            logged = False  


                            if driverx == False:

                                driver.quit()

                                try:

                                    setup_selenium_firefox()

                                    # Encontra o caminho do geckodriver
                                    geckodriver_path = os.path.join(os.getcwd(), 'geckodriver')
                                    
                                    # Configura o Selenium para usar o Firefox
                                    service = Service(geckodriver_path)
                                    driver = webdriver.Firefox(service=service)

                                    driverx = True

                                except:

                                    print('PROBLEMA AO ABRIR NAVEGADOR')

                            
                            # Deslogadndo

                            
                            if agentes_qtd > 0:

                                if agente_index < (agentes_qtd-1):
                                    agente_index = agente_index + 1
                                    print('  [!] MUDANDO AGENTE, NOVA INDEX: '+str(agente_index))
                                else:
                                    agente_index = 0   
                            else:

                                print('  [!] NENHUM AGENTE DISPONÍVEL NO MOMENTO - STEP 2 ** ESPERANDO 10 MINUTOS')
                                time.sleep(600)
                    
                    else:

                        print('  [!] NENHUM AGENTE DISPONÍVEL NO MOMENTO - STEP 1 ** ESPERANDO 10 MINUTOS')
                        time.sleep(600)

                    time.sleep(3)
            else:

                print('  [!] [ '+campanha_data['campanha_nome']+' ] NÃO EXISTEM DEMANDAS PENDENTES: ', len(demandas_pendentes))
            
            time.sleep(10)

    else:

        print('[!] NÃO EXISTEM CAMPANHAS ATIVAS.')

    
    # Abre uma página para testar
    # driver.get("https://www.instagram.com")
    # print(driver.title)
    
    # # Fecha o navegador
    # driver.quit()
