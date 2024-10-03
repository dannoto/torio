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
from bs4 import BeautifulSoup


def send_sms_oferta(oferta_numero, oferta_conteudo):

    driver.get('https://ccoanalitica.com/torio_sms/smsbox/compose')

    time.sleep(5)


    # Selecionar dispositivo
    try:

        element_a = driver.find_element(By.CSS_SELECTOR, '#device_id')
        element_a_ = Select(element_a)
        element_a_.select_by_index(1) 

    except:
        print('Erro selecionar dispositivo')
        return False
    
    time.sleep(2)
    
    # Digitar numero
    
    try:

        element_x = driver.find_element(By.CSS_SELECTOR, '.select2-search__field')
        element_x.send_keys(oferta_numero)

        time.sleep(2)

        element_x.send_keys(Keys.RETURN)

    except:

        print('Erro digitar numero ')
        return False

    time.sleep(2)
    # text area

    try:

        element_b = driver.find_element(By.CSS_SELECTOR, '#compose-textarea')
        element_b.send_keys(oferta_conteudo)

    except:

        print('Erro digitar conteudo ')
        return False
    
    time.sleep(1)

    # btn enviar

    try:

        time.sleep(2)

        element_c = driver.find_element(By.CSS_SELECTOR, 'button.btn-primary:nth-child(2)')
        element_c.click()
        # time.sleep(3)

    except:

        try:

            element_c = driver.find_element(By.XPATH, '/html/body/div[1]/div[1]/section[2]/div/div[1]/div/form/div[3]/div/button[2]')
            element_c.click()
            

        except:
            print('Erro BTN ENVIAR  2 tentativas')
            return False

        pass

        # print('Erro btn enviar oferta ')
        # return False
    
    time.sleep(5)
    
    return True   

def login_sms(driver):

    driver.get('https://ccoanalitica.com/torio_sms/login')
    time.sleep(5)

    try:
        username_input = driver.find_element(By.CSS_SELECTOR, '#email')
        password_input = driver.find_element(By.CSS_SELECTOR, '#password')

        username_input.send_keys('dantars@outlook.com')
        
        time.sleep(1)

        password_input.send_keys('Effizienz10')
        
        time.sleep(1)

        password_input.send_keys(Keys.RETURN)


        time.sleep(10)

        return True

    except:
        print('Erro ao logar')
        sys.exit()

def update_oferta_status(oferta_id):

    url = base_url+"update_sms_oferta_status?oferta_id="+str(oferta_id)
    # print(url)
    
 
    response = requests.get(url)

    if response.status_code == 200:

        # data = json.loads(response.content)
        print('Oferta #'+str(oferta_id)+' atualizada com sucesso')
        return True
        
    else:

        return False 

def get_sms_ofertas_pendentes():

    url = base_url+"get_sms_ofertas_pendentes"
    
 
    response = requests.get(url)

    if response.status_code == 200:

        data = json.loads(response.content)
        return data
        
    else:

        return False 


if __name__ == "__main__":


    base_url = "https://ccoanalitica.com/torio/api/torio/"

    driver = webdriver.Firefox()

    login =  login_sms(driver)

    if login:

        print('Logado')
        driver.get('https://ccoanalitica.com/torio_sms/smsbox/compose')
        time.sleep(5)

        


    while True:

        sms_ofertas_pendentes = get_sms_ofertas_pendentes()

        if (len(sms_ofertas_pendentes) > 0 ):

            print('Ofertas Encontradas: '+str(len(sms_ofertas_pendentes)))

            for oferta in sms_ofertas_pendentes:

                oferta_numero = oferta['oferta_numero']
                oferta_conteudo = oferta['oferta_conteudo']

                print('=========\n')
                print ('\n OFERTA ID: ', oferta['id'])
                print ('\n OFERTA NUMERO: ', oferta_numero)
                print('\n OFERTA CONTEÚDO: ', oferta_conteudo)
                


                send_oferta = send_sms_oferta(oferta_numero, oferta_conteudo)

                if send_oferta:

                    update_oferta_status(oferta['id'])    

                else:
                    print('\nErro ao enviar oferta.')
                
                print('=======\n')
                
        else:

            print('Nenhuma oferta pendente')

        time.sleep(1)

        

   