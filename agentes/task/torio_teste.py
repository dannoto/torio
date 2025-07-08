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




media_id = "3418558052924988026"

headers = {
                'Accept': '*/*',
                'Accept-Encoding': 'gzip, deflate, br',
                'Accept-Language': 'pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
                # 'Cookie': self.header_data[self.header_current]['agente_cookie'],
                'Cookie': 'wd=1366x179; mid=Z6ZViQALAAFjfFuP84ECDfC5FNnU; datr=hlWmZ9zKfsxyaUY_WfOXWeod; ig_did=7CDEE698-B43C-41B2-B57E-5CB13BA7F30D; ig_nrcb=1; ps_l=1; ps_n=1; sessionid=6322890944%3AlzsE3aquFYbNpo%3A4%3AAYfepvth3PGBiGPnkx23ZdrBHiXsaj5ypJO5rkuSUg; rur="VLL\0546322890944\0541783465900:01fe409d2db11ca5cf6adba03601cc298f765751254bab49abe76f152be6067b7b2798e9"; ds_user_id=6322890944; csrftoken=BEVBzeQ5pR89OIA95XpryLfST50qaLDT',
                # 'Cookie': 'g_did=1E36CBE8-F02A-49AA-BD2B-E1A5C0111ED0; datr=i-UrZsTnMEkNQqCkeoO2UKJu; ig_nrcb=1; fbm_124024574287414=base_domain=.instagram.com; ps_n=1; ps_l=1; mid=Zm4XgQALAAEMoTlQzk2A2V8ajQLo; ds_user_id=61013886138; csrftoken=rhPONWnbfDRydarqzs9IbIvfG8aQvmWt; fbsr_124024574287414=-GnZN6ESQZdu1eg0YDxWNLVZkS3R0kru_PT_FSclpuE.eyJ1c2VyX2lkIjoiMTAwMDg5NDAyNTYzMTE3IiwiY29kZSI6IkFRQVhzS2ZZYWw5OEpIb3FpNGR3WGhBOXRZZ184TXViN0doRmtqbU9KYWJVSzllaGVUQVhsVDZ4Z1BfUXZ5eG9ZQlF4UGh4QUF1T19fU2MxM1BlcnRxd1VQckZhVngzbEIzVjlvSVU4Z29aX0Y0V3o5ZEczLU9GX1V4cXZ6eFR6TzJWWXltWldBWlN1WE9JS2R2OVhIaUw3b2oya2w1ZUg0NUEyNE11Nm0yWEhOVlNlNFNnYjQ1RGc2anhiUDdQRGU2SW9lOEhScndxV19SR0VWbVFKREFMcmtVNlptc3NyVUNONVp0OEJ2aTRwUlRBZDlqdjBhM0N4eDFscVZWNVNBMk0tc21rZ0lYTFdmckRiaGFfUng4eThkOUI2YTFqaWpOVGFIeEExazVrOURzc3dZcHF2SG9YZlVrUzc2N2dZUWp4bi1ENmktdjNaeG9LYWRnckNnTXRCZHJJT0lDN2V6dEI5X1BkMzZWdFhCZyIsIm9hdXRoX3Rva2VuIjoiRUFBQnd6TGl4bmpZQk80WEN6NXpCdm1LN1F5R0NFRlpCbFRUblc3bmx5N1pDMEhGcjVBRGNXM1dhRVpBckFtWG1OR2VxMThBcW44RUdnZVZSOU5FZTdaQWF4SGdzZzFTTTFaQnVGejBmSHpIVGNJZEJ1UmJzVFRMVTNaQ1N5TFpCZnRZSnEybjFmeFNUSktDWkNPMThjTjRuNWh3VDBoSlU4enlUT2tXR3hObHU5ZVpDSlBuYTJZN2dBUHBxSmxaQVViTVBCT1pCM0VaRCIsImFsZ29yaXRobSI6IkhNQUMtU0hBMjU2IiwiaXNzdWVkX2F0IjoxNzI3MDY1ODQ3fQ; fbsr_124024574287414=Pk60WKWC-eWKho4L43cKlid1JTngVaObISl_RQTXWPk.eyJ1c2VyX2lkIjoiMTAwMDg5NDAyNTYzMTE3IiwiY29kZSI6IkFRQlNEZkVCTUdlZ0xROW1aSUFOSnBpbFFGTGQzeEY4Z2lOTHBEd2VBVmVOUXo1czVTeU13UzBkMUtqeXh2NnQySmtSSTExTG5ORGlYUGJzU3dyYWplZHVDa2JsYjdqN0hldVNYMXRDNnc2NEhqWlZnNTByWm1Lb1dWZkFrSGRIWjFkSHRPbmVjejlwMFJ4ektmckh3M1FTV2hCeFh4UkhFTlpEYVl1TFlfQ2ZLS09kTEs0dmEyUXE1QTBtUXlrZkVoT3lPWWhDS1c4aUVSdW5vdUFGdkplY2Z1MXdoNUlIa0hSdFVlVllxQkNZNmc5aTVfa1RvOWtFRDQ1QXRIS005TlhHVHJDWV9HVVhUMlZPa1oyRGR5Z1Etc1dacGpiRWJaRm00TXRnZGlOY3o3RTFWRE91OTFMcUdXQV9Oa21tTF8ySi1VNDNiS2Z3ZUZON0dQRVJQNHVCVERfTFBFNkpRRE5hS2VyMTdSbW53QSIsIm9hdXRoX3Rva2VuIjoiRUFBQnd6TGl4bmpZQk93UjV5TlpCbFBteVByNWdZV0tIRjNaQ1dzV2MxcE1rdHpwaFpBYzZyMlBvZkVSdXgyajRSbHllVUJNMHBQR3N0N0sxUlpBckJhYmY5WkI4aEcxNjBodE9zUm5GTVVoaXcxcWlVZ0tSV2dFb09JdnQwYXBkWkF4bXRPRzB0N2ZxeHFsYTFINGFhc2hGaDZEcE1VRnQ3WkJjcTJzNXJZSzk5VjRCTlJ5Y3ZUTnRaQ1A1a2hNWkFiS0dsQ2RZWkQiLCJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImlzc3VlZF9hdCI6MTcyNzExMDE1N30; shbid="7447\05461013886138\0541758646158:01f7a8c0473063e72d8e087d8ac3666ebeb5a5795890dcdb5f03f82569b8bcac35f3c811"; shbts="1727110158\05461013886138\0541758646158:01f70f5bb33b74c86fc77e2276c9e9aecb3c6f4f12fc263f4564c4503315845efee66995"; sessionid=61013886138%3A4hY4q8IsFe1IOi%3A6%3AAYeLfUbOFleF0USBt-gJzTu63Q4OJqhR1Cw9qquE7A; rur="NHA\05461013886138\0541758646171:01f7efe951deb9f50639d6945226c4888cbceb3b85fa8ee2b6a19ab6003f455fc23ecb65"; wd=1312x149',
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
                'X-Csrftoken': 'BEVBzeQ5pR89OIA95XpryLfST50qaLDT',
                'X-Ig-App-Id': '936619743392459',
                'X-Ig-Www-Claim': 'hmac.AR2kovJ4-DcOAF0d43NiUcqAx69DUcqPe2rRZLMjoHsdi9v6',
                'X-Requested-With': 'XMLHttpRequest'
        }
        

def getLikes( headers, media_id):
     
        url = 'https://www.instagram.com/api/v1/media/'+media_id+'/likers/'
        response = requests.get(url, headers=headers)

        print(response.content)

        if response.status_code == 200:

            print("Requisição getLikes bem-sucedida!")
            data = json.loads(response.content)

            print(data)

            return data
        else:
            # self.updateTarefaStatus(base_url, tarefa_id, 3)
            print("Erro na requisição getLikes:", response.status_code)
            return False


getLikes(headers, media_id)