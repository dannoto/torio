# VERSAO 4.0
# HEADERS MUDAM DINAMICAMENTE APOS SEREM BLOQUEADAS

from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.firefox.service import Service
import os

import mysql.connector
import logging

import time
import requests
import json
import re
from urllib.parse import urlparse
import time
import datetime
import random
import winsound

from bs4 import BeautifulSoup

# Tório
class Scraper:

    def __init__(self):

        base_url = "https://ccoanalitica.com/torio/api/torio/"

        headers = {
                'Accept': '*/*',
                'Accept-Encoding': 'gzip, deflate, br',
                'Accept-Language': 'pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
                # 'Cookie': self.header_data[self.header_current]['agente_cookie'],
                'Cookie': 'g_did=1E36CBE8-F02A-49AA-BD2B-E1A5C0111ED0; datr=i-UrZsTnMEkNQqCkeoO2UKJu; ig_nrcb=1; fbm_124024574287414=base_domain=.instagram.com; ps_n=1; ps_l=1; mid=Zm4XgQALAAEMoTlQzk2A2V8ajQLo; ds_user_id=61013886138; csrftoken=rhPONWnbfDRydarqzs9IbIvfG8aQvmWt; fbsr_124024574287414=-GnZN6ESQZdu1eg0YDxWNLVZkS3R0kru_PT_FSclpuE.eyJ1c2VyX2lkIjoiMTAwMDg5NDAyNTYzMTE3IiwiY29kZSI6IkFRQVhzS2ZZYWw5OEpIb3FpNGR3WGhBOXRZZ184TXViN0doRmtqbU9KYWJVSzllaGVUQVhsVDZ4Z1BfUXZ5eG9ZQlF4UGh4QUF1T19fU2MxM1BlcnRxd1VQckZhVngzbEIzVjlvSVU4Z29aX0Y0V3o5ZEczLU9GX1V4cXZ6eFR6TzJWWXltWldBWlN1WE9JS2R2OVhIaUw3b2oya2w1ZUg0NUEyNE11Nm0yWEhOVlNlNFNnYjQ1RGc2anhiUDdQRGU2SW9lOEhScndxV19SR0VWbVFKREFMcmtVNlptc3NyVUNONVp0OEJ2aTRwUlRBZDlqdjBhM0N4eDFscVZWNVNBMk0tc21rZ0lYTFdmckRiaGFfUng4eThkOUI2YTFqaWpOVGFIeEExazVrOURzc3dZcHF2SG9YZlVrUzc2N2dZUWp4bi1ENmktdjNaeG9LYWRnckNnTXRCZHJJT0lDN2V6dEI5X1BkMzZWdFhCZyIsIm9hdXRoX3Rva2VuIjoiRUFBQnd6TGl4bmpZQk80WEN6NXpCdm1LN1F5R0NFRlpCbFRUblc3bmx5N1pDMEhGcjVBRGNXM1dhRVpBckFtWG1OR2VxMThBcW44RUdnZVZSOU5FZTdaQWF4SGdzZzFTTTFaQnVGejBmSHpIVGNJZEJ1UmJzVFRMVTNaQ1N5TFpCZnRZSnEybjFmeFNUSktDWkNPMThjTjRuNWh3VDBoSlU4enlUT2tXR3hObHU5ZVpDSlBuYTJZN2dBUHBxSmxaQVViTVBCT1pCM0VaRCIsImFsZ29yaXRobSI6IkhNQUMtU0hBMjU2IiwiaXNzdWVkX2F0IjoxNzI3MDY1ODQ3fQ; fbsr_124024574287414=Pk60WKWC-eWKho4L43cKlid1JTngVaObISl_RQTXWPk.eyJ1c2VyX2lkIjoiMTAwMDg5NDAyNTYzMTE3IiwiY29kZSI6IkFRQlNEZkVCTUdlZ0xROW1aSUFOSnBpbFFGTGQzeEY4Z2lOTHBEd2VBVmVOUXo1czVTeU13UzBkMUtqeXh2NnQySmtSSTExTG5ORGlYUGJzU3dyYWplZHVDa2JsYjdqN0hldVNYMXRDNnc2NEhqWlZnNTByWm1Lb1dWZkFrSGRIWjFkSHRPbmVjejlwMFJ4ektmckh3M1FTV2hCeFh4UkhFTlpEYVl1TFlfQ2ZLS09kTEs0dmEyUXE1QTBtUXlrZkVoT3lPWWhDS1c4aUVSdW5vdUFGdkplY2Z1MXdoNUlIa0hSdFVlVllxQkNZNmc5aTVfa1RvOWtFRDQ1QXRIS005TlhHVHJDWV9HVVhUMlZPa1oyRGR5Z1Etc1dacGpiRWJaRm00TXRnZGlOY3o3RTFWRE91OTFMcUdXQV9Oa21tTF8ySi1VNDNiS2Z3ZUZON0dQRVJQNHVCVERfTFBFNkpRRE5hS2VyMTdSbW53QSIsIm9hdXRoX3Rva2VuIjoiRUFBQnd6TGl4bmpZQk93UjV5TlpCbFBteVByNWdZV0tIRjNaQ1dzV2MxcE1rdHpwaFpBYzZyMlBvZkVSdXgyajRSbHllVUJNMHBQR3N0N0sxUlpBckJhYmY5WkI4aEcxNjBodE9zUm5GTVVoaXcxcWlVZ0tSV2dFb09JdnQwYXBkWkF4bXRPRzB0N2ZxeHFsYTFINGFhc2hGaDZEcE1VRnQ3WkJjcTJzNXJZSzk5VjRCTlJ5Y3ZUTnRaQ1A1a2hNWkFiS0dsQ2RZWkQiLCJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImlzc3VlZF9hdCI6MTcyNzExMDE1N30; shbid="7447\05461013886138\0541758646158:01f7a8c0473063e72d8e087d8ac3666ebeb5a5795890dcdb5f03f82569b8bcac35f3c811"; shbts="1727110158\05461013886138\0541758646158:01f70f5bb33b74c86fc77e2276c9e9aecb3c6f4f12fc263f4564c4503315845efee66995"; sessionid=61013886138%3A4hY4q8IsFe1IOi%3A6%3AAYeLfUbOFleF0USBt-gJzTu63Q4OJqhR1Cw9qquE7A; rur="NHA\05461013886138\0541758646171:01f7efe951deb9f50639d6945226c4888cbceb3b85fa8ee2b6a19ab6003f455fc23ecb65"; wd=1312x149',
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
        
        
        while True:
               
            tarefas =  self.get_tarefas_ativas(base_url) 
            
            try:
            
                if len(tarefas) > 0 :    

                    for tarefa in tarefas:
                        
                        if (tarefa['tarefa_tipo'] == "post"):
                            
                            print('\n [!] Iniciando tarefa : '+tarefa['tarefa_nome'])
                            self.extract_from_post( headers, base_url,  tarefa['tarefa_url'], tarefa['id'], tarefa['tarefa_tag'])

                        elif (tarefa['tarefa_tipo'] == "feed"):
                            
                            print('[!] Iniciando tarefa tipo: '+tarefa['tarefa_tipo'])                                 
                       
                else:

                    print('\n [!] Nenhnuma tarefa ativa. ')
                    time.sleep(5)
                    
            except Exception as e:
                
                print("===========  WHILE EXCEPTION ===============", e)
                pass

    def addInstaLeadDemanda(self, base_url, demanda):
                
        url = base_url + "add_instalead_demanda"
        # print(url)
        data = {
            'tarefa_id': demanda['tarefa_id'],
            'tag_id': demanda['tag_id'],
            'username': demanda['username'],
            'is_private': demanda['is_private'],
            'full_name': demanda['full_name'],
            'interacao_tipo': demanda['interacao_tipo'],
            'interacao_conteudo': demanda['interacao_conteudo'],
            'interacao_data': demanda['interacao_data'],
            'post_id': demanda['post_id'],
            'post_slug': demanda['post_slug'],
            'post_data': demanda['post_data'],
            'post_descricao': demanda['post_descricao'],
            'post_imagem': demanda['post_imagem'],
            'processado':demanda['processado']
        }
        # print(data)

        response = requests.post(url, data=data)

        if response.status_code == 200:
            print("Requisição addDemanda bem-sucedida: "+data['username'])
            response_data = json.loads(response.content)
            
            # print(response_data)
            return response_data
        else:
            print("Erro na requisição addDemanda:", response.status_code)
            return False  

    def get_tarefas_ativas(self, base_url):
        
        
        url = base_url+"/get_tarefas_ativas"
        
        response = requests.get(url)

        if response.status_code == 200:
            
            # print("Requisição getTarefasAtivas bem-sucedida!")
            data = json.loads(response.content)
        
            return data
        
        else:

            # print("Erro na requisição getTarefasAtivas:", response.status_code)
            return False  

    def time_stamp_to_date_time(self, timestamp):

        try:
            # Converter o timestamp para um objeto de data e hora
            data_hora = datetime.datetime.fromtimestamp(timestamp)

            # Imprimir a data e hora no formato desejado (por exemplo, AAAA-MM-DD HH:MM:SS)
            formato_desejado = "%Y-%m-%d %H:%M:%S"
            data_hora_formatada = data_hora.strftime(formato_desejado)

            # print("Timestamp:", timestamp)
            # print("Data e Hora:", data_hora_formatada)    
            
            return data_hora_formatada
        
        except Exception as e:

            print('Exception time_stamp_to_date_time', e)

    def extract_from_post(self, headers, base_url, post_url, tarefa_id, tag_id):
        
        print("[!] Analisando URL: "+post_url)
        
        try:

            
            self.updateTarefaStatus(base_url, tarefa_id, 1)
            
            media_id = self.getPostId(headers, post_url)
            post_dados = self.getPost( headers, media_id)
            
            post_likes = self.getLikes(headers, media_id, tarefa_id, base_url)
            post_comments = self.getComments(headers, media_id, tarefa_id, base_url )
            
            user_data = []
            
            print("\n ======= Extraindo Interacoes ======= \n")
            print("\n [!] Extraindo Likes \n")
        
            try:
                for like in post_likes['users']:
                                
                    username = like['username']
                    full_name = like['full_name']
                    is_private =like['is_private']
                    text = ""
                    interacao_tipo = "like"
                
                    post_id = post_dados['pk']
                    post_slug = post_dados['code']

                    try:

                        interacao_data = self.time_stamp_to_date_time(post_dados['caption']['created_at_utc'])
                        post_data = self.time_stamp_to_date_time(post_dados['caption']['created_at_utc'])
                        post_descricao = post_dados['caption']['text']

                    except Exception as e:
                        
                        print(f'\n Erro POST DADOS, RECOVERYING', e)
                        interacao_data = ""
                        post_data = ""
                        post_descricao = ""

                    
                    post_imagem = post_dados['image_versions2']['candidates'][0]['url']
                    
                    # Verifica se o username já existe no user_data
                    user_exists = False
                    for user_info in user_data:
                        if user_info['username'] == username:
                            # print('substituindo: '+user_info['username'])
                            user_info['full_name'] = full_name  # Atualiza o nome completo
                            user_info['interacao_tipo'] = interacao_tipo  # Atualiza o tipo de interação
                            user_info['interacao_data'] = interacao_data 
                            user_exists = True
                            break

                    # Se o username não existir, adiciona ao user_data
                    if not user_exists:
                        user_data.append({
                            'tarefa_id': tarefa_id,
                            'tag_id': tag_id,
                            'username': username,
                            'is_private': is_private,
                            'full_name': full_name,
                            'interacao_tipo': interacao_tipo,
                            'interacao_conteudo': text,
                            'interacao_data': interacao_data,
                            'post_id':post_id,
                            'post_slug':post_slug,
                            'post_data': post_data,
                            'post_descricao': post_descricao,
                            'post_imagem':post_imagem,
                            'processado': 0               
                        })
            except Exception as e:
                self.updateTarefaStatus(base_url, tarefa_id, 3)
                print(f'\n Erro foreach Extraindo Likes', e)
                
            print("\n ======= Exibindo Comentários ======= \n")
            print("\n [!] Extraindo Comentários \n")

            try:
                for comment in post_comments['comments']:
        
                    username = comment['user']['username']
                    full_name =comment['user']['full_name']
                    is_private =comment['user']['is_private']
                    text = comment['text']
                    interacao_tipo = "comentario"
                    interacao_data =  self.time_stamp_to_date_time(comment['created_at_utc'])
                    
                    post_id = post_dados['pk']
                    post_slug = post_dados['code']

                   
                    try:

                        post_data = self.time_stamp_to_date_time(post_dados['caption']['created_at_utc'])
                        post_descricao = post_dados['caption']['text']

                    except Exception as e:

                        print(f'\n Erro POST DADOS, RECOVERYING', e)

                        post_data = ""
                        post_descricao = ""

                    post_imagem = post_dados['image_versions2']['candidates'][0]['url']

                    
                    # Verifica se o username já existe no user_data
                    user_exists = False
                    for user_info in user_data:
                        if user_info['username'] == username:
                            # print('substituindo: '+user_info['username'])
                            user_info['full_name'] = full_name  # Atualiza o nome completo
                            user_info['interacao_tipo'] = interacao_tipo  # Atualiza o tipo de interação
                            user_info['text'] = text  # Atualiza o texto do comentário
                            user_info['interacao_data'] = interacao_data 
                            user_exists = True
                            break

                    # Se o username não existir, adiciona ao user_data
                    if not user_exists:
                        user_data.append({
                            'tarefa_id': tarefa_id,
                            'tag_id': tag_id,
                            'username': username,
                            'is_private': is_private,
                            'full_name': full_name,
                            'interacao_tipo': interacao_tipo,
                            'interacao_conteudo': text,
                            'interacao_data': interacao_data,
                            'post_id':post_id,
                            'post_slug':post_slug,
                            'post_data': post_data,
                            'post_descricao': post_descricao,
                            'post_imagem':post_imagem,
                            'processado': 0
                        })    
            except Exception as e:
                self.updateTarefaStatus(base_url, tarefa_id, 3)
                print(f'\n Erro foreach Extraindo Comentários', e)    
            
            print('Demanda encontradas: ', len(user_data))

            if len(user_data) > 0:
                for user in user_data:
                    # print(user)
                    # # print(' ')
                    self.addInstaLeadDemanda( base_url, user)
                
                # Entrair Usuarios             
                # self.extractUserInfo( headers, user_data, base_url, tarefa_id, tag_id)
                self.updateTarefaStatus(base_url, tarefa_id, 2)

        except Exception as e:
            self.updateTarefaStatus(base_url, tarefa_id, 3)
            print(e)
            print(f'\n\n ERRO EXTRAIR POST  \n')
            
    # def get_instagram_media_id(self, instagram_url):

    #     print('PEGANDO MEDIA ID, MÉTODO SECUNDÁRIO: '+instagram_url)
    #     # Send a request to the Instagram URL
    #     response = requests.get(instagram_url)
        
    #     # Parse the HTML content using BeautifulSoup
    #     soup = BeautifulSoup(response.text, 'html.parser')
        
    #     # Look for the meta tag that contains the media ID
    #     media_id_tag = soup.find('meta', {'property': 'al:ios:url'})
        
    #     if media_id_tag and 'content' in media_id_tag.attrs:
    #         # Extract the media ID from the content attribute
    #         media_id = media_id_tag['content'].split('media?id=')[-1]
    #         print('MEDIA ID ENCONTRADO: ', media_id)
    #         return media_id
    #     else:
    #         return False
    
    def instagram_code_to_media_id(self, code):

        charmap = {
            'A': '0',
            'B': '1',
            'C': '2',
            'D': '3',
            'E': '4',
            'F': '5',
            'G': '6',
            'H': '7',
            'I': '8',
            'J': '9',
            'K': 'a',
            'L': 'b',
            'M': 'c',
            'N': 'd',
            'O': 'e',
            'P': 'f',
            'Q': 'g',
            'R': 'h',
            'S': 'i',
            'T': 'j',
            'U': 'k',
            'V': 'l',
            'W': 'm',
            'X': 'n',
            'Y': 'o',
            'Z': 'p',
            'a': 'q',
            'b': 'r',
            'c': 's',
            'd': 't',
            'e': 'u',
            'f': 'v',
            'g': 'w',
            'h': 'x',
            'i': 'y',
            'j': 'z',
            'k': 'A',
            'l': 'B',
            'm': 'C',
            'n': 'D',
            'o': 'E',
            'p': 'F',
            'q': 'G',
            'r': 'H',
            's': 'I',
            't': 'J',
            'u': 'K',
            'v': 'L',
            'w': 'M',
            'x': 'N',
            'y': 'O',
            'z': 'P',
            '0': 'Q',
            '1': 'R',
            '2': 'S',
            '3': 'T',
            '4': 'U',
            '5': 'V',
            '6': 'W',
            '7': 'X',
            '8': 'Y',
            '9': 'Z',
            '-': '$',
            '_': '_'
        }

        id = ""
        for letter in code:
            id += charmap[letter]
    
        alphabet = list(charmap.values())
        number = 0
        for char in id:
            number = number * 64 + alphabet.index(char)


        print('POST ID DECIFRADO: ', number)


        return str(number)
  
    def getURLPostSlug(self, url):
        # Extrai a slu
        parsed_url = urlparse(url)
        path = parsed_url.path
        print('path '+path)
        return path
    
    def getPostId(self, headers, url):
        ''
        
        url_extracted = self.getURLPostSlug(url)
        code = url_extracted.replace('/reel/', '').strip('/')
        code = url_extracted.replace('/p/', '').strip('/')
        code = url_extracted.replace('p/', '').strip('/')

        print('code' ,  code)
        

        return self.instagram_code_to_media_id(code)


        # params={'route_urls[0]': url_extracted, }
        
       
        # response = requests.get(url, data=params, headers=headers)

        # if response.status_code == 200:
            
        #     pattern = r'"media_id":"(\d+)"'
        #     match = re.search(pattern, response.content.decode('utf-8'))

        #     if match:
        #         media_id = match.group(1)  # Obtendo o valor do media_id capturado pelo grupo (\d+)
        #         print("[!] Media ID encontrado:", media_id)
        #         return media_id
        #     else:
        #         print("[?] Nenhuma correspondência para media_id encontrada.")
        #         # return self.get_instagram_media_id(url)
            

        # else:
        #     print("[!] Erro na requisição getPostId:", response.status_code)
        #     return False
    
    def getPost(self, headers, post_id):
        
        url = 'https://www.instagram.com/api/v1/media/'+post_id+'/info/'
        
        response = requests.get(url, headers=headers)

        if response.status_code == 200:
            
            print("Requisição getPost bem-sucedida!")
            data = json.loads(response.content)
            
            # print(data['items'][0]['created_at_utc'])
            
            return data['items'][0]
        
        else:
            print("Erro na requisição getPost:", response.status_code)
            return False   
        
    def getComments(self, headers, media_id, tarefa_id, base_url):
        
        url = 'https://www.instagram.com/api/v1/media/'+media_id+'/comments/'
        response = requests.get(url, headers=headers)

        # print(response.content)

        if response.status_code == 200:
            print("Requisição getComments bem-sucedida!")
            data = json.loads(response.content)
            return data
        else:
            self.updateTarefaStatus(base_url, tarefa_id, 3)
            print("Erro na requisição getComments:", response.status_code)
            return False
        
    def getLikes(self, headers, media_id, tarefa_id,base_url):
        # {
        #     "pk": "18191452135304158",
        #     "user_id": "485182985",
        #     "type": 0,
        #     "did_report_as_spam": false,
        #     "created_at": 1702757367,
        #     "created_at_utc": 1702757367,
        #     "content_type": "comment",
        #     "status": "Active",
        #     "bit_flags": 0,
        #     "share_enabled": false,
        #     "is_ranked_comment": false,
        #     "media_id": "3259224632035396790",
        #     "user": {
        #         "pk": "485182985",
        #         "pk_id": "485182985",
        #         "username": "shennysesilva",
        #         "full_name": "Shennyse Silva",
        #         "is_private": true,
        #         "strong_id__": "485182985",
        #         "fbid_v2": "17841401889557580",
        #         "is_verified": false,
        #         "profile_pic_id": "3268832239004609667_485182985",
        #         "profile_pic_url": "https://instagram.fgyn11-1.fna.fbcdn.net/v/t51.2885-19/413289070_7389228837767375_1666387982918105989_n.jpg?stp=dst-jpg_s150x150\\u0026_nc_ht=instagram.fgyn11-1.fna.fbcdn.net\\u0026_nc_cat=111\\u0026_nc_ohc=9c8gP586kR0AX-zkAa1\\u0026edm=AId3EpQBAAAA\\u0026ccb=7-5\\u0026oh=00_AfB0USQf_uDc0h2BU_4EFTUjg--lr5jlRzkb6rGJqWNvfw\\u0026oe=659AA2D6\\u0026_nc_sid=f5838a",
        #         "is_mentionable": true,
        #         "latest_reel_media": 0,
        #         "latest_besties_reel_media": 0
        #     },
        #     "text":"Parab\xc3\xa9ns!!! Sucesso, Carl\xc3\xa3o!\xf0\x9f\x91\x8f",
        #     "is_covered": false,
        #     "inline_composer_display_condition": "never",
        #     "has_liked_comment": false,
        #     "comment_like_count": 1,
        #     "preview_child_comments": [],
        #     "other_preview_users": [],
        #     "private_reply_status": 0,
        #     "has_translation": true
        # }
        url = 'https://www.instagram.com/api/v1/media/'+media_id+'/likers/'
        response = requests.get(url, headers=headers)

        # print(response.content)

        if response.status_code == 200:
            print("Requisição getLikes bem-sucedida!")
            data = json.loads(response.content)

            return data
        else:
            self.updateTarefaStatus(base_url, tarefa_id, 3)
            print("Erro na requisição getLikes:", response.status_code)
            return False
    
    def updateTarefaStatus(self, base_url, tarefa_id, tarefa_status):
        
        # print('[!] Mudando status para Processando: '+str(tarefa_id)+'')
        
        url = base_url+"/update_tarefa_status?tarefa_id="+str(tarefa_id)+"&tarefa_status="+str(tarefa_status)+" "
        
        response = requests.get(url)

        if response.status_code == 200:
            
            # print("Requisição updateTarefaStatus bem-sucedida!")
            data = json.loads(response.content)
        
            return data
        
        else:
            # print("Erro na requisição updateTarefaStatus:", response.status_code)
            return False 
        
Scraper()