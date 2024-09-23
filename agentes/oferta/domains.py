import http.client
import json
import re


def ok():

    conn = http.client.HTTPSConnection("privatix-temp-mail-v1.p.rapidapi.com")

    headers = {
        'x-rapidapi-key': "59676de38dmshc3ef26892aa3735p15c5e7jsn87eb55dc67d4",
        'x-rapidapi-host': "privatix-temp-mail-v1.p.rapidapi.com"
    }

    conn.request("GET", "/request/mail/id/7cd6127ab1e1d7c3da8d560e728ad2eb/", headers=headers)

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
                
                string = json_data[0]['mail_subject']
                print(string)
                code = re.findall(r'\d+', string)
                code = ''.join(code)

                print(code)

            
            else:
                print('NENHUM E-MAIL CHEGOU')
                return False


            
        
        except json.JSONDecodeError:

            print("Erro ao decodificar a resposta em JSON.")
            
            return False
    else:

        print(f"Erro na requisição. Status: {status}")
        return False
ok()