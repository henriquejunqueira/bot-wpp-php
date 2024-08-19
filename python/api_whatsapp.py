from sys import executable
from selenium import webdriver
import os
import time
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import requests
import clipboard

# Função para obter configurações do WhatsApp
def obter_configuracoes_whatsapp(chave):
    agent = {"User-Agent": 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'}
    api = requests.get(f"https://editacodigo.com.br/index/api-whatsapp/{chave}", headers=agent)
    time.sleep(1)

    if api.status_code == 302:  # Redirecionamento
        print("A URL redirecionou para:", api.headers['Location'])
        # Você pode fazer outra requisição para a URL de redirecionamento, se necessário
        redirected_url = api.headers['Location']
        response = requests.get(redirected_url, headers=agent)

    api = api.text
    print(f"Resposta da API: {api}")
    api = api.split(".n.")

    if len(api) < 9:  # Verifique se há pelo menos 9 elementos
        raise ValueError("Resposta da API não contém dados suficientes.")

    bolinha_notificacao = api[3].strip()
    contato_cliente = api[4].strip()
    caixa_msg = api[5].strip()
    msg_cliente = api[6].strip()
    caixa_de_pesquisa = api[7].strip()
    pega_contato = api[8].strip()
    return (bolinha_notificacao, contato_cliente, caixa_msg, msg_cliente, caixa_de_pesquisa, pega_contato)

# Função para carregar a página do WhatsApp
def carregar_pagina_whatsapp(session_directory, site):
    chrome_options = Options()
    dir_path = os.getcwd()
    chrome_options.add_argument("user-data-dir=" + os.path.abspath(session_directory))
    driver = webdriver.Chrome(service=Service(executable_path='./chromedriver.exe'), options=chrome_options)
    driver.get(site)
    return driver

# Função para abrir a notificação
def abrir_notificacao(driver, bolinha_notificacao):
    try:
        bolinha = driver.find_elements(By.CLASS_NAME, bolinha_notificacao)[-1]
        acao_bolinha = webdriver.common.action_chains.ActionChains(driver)
        acao_bolinha.move_to_element_with_offset(bolinha, 0, -20)
        acao_bolinha.click().perform()
        return bolinha.text
    except Exception as e:
        print(f'Erro ao abrir notificação: {e}')

# Função para pegar o contato
def pega_contato(driver, contato_cliente):
    try:
        telefone_cliente = driver.find_element(By.XPATH, contato_cliente)
        return telefone_cliente.text
    except Exception as e:
        print(f'Erro ao pegar contato: {e}')

# Função para enviar mensagens para o servidor
def envia_as_msg_para_servidor(driver, msg_cliente, telefone_final, usuario, pagina):
    try:
        todas_as_mensagens = driver.find_elements(By.CLASS_NAME, msg_cliente)
        todas_as_mensagens_texto = [mensagem.text for mensagem in todas_as_mensagens]
        mensagem = todas_as_mensagens_texto[-1]
        print(mensagem)
        agent = {"User-Agent": 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'}
        requests.get(pagina, params={'msg': mensagem, 'telefone': telefone_final, 'usuario': usuario}, headers=agent)
        webdriver.ActionChains(driver).send_keys(Keys.ESCAPE).perform()
    except Exception as e:
        print(f'Erro ao enviar mensagem para o servidor: {e}')

# Função para enviar mensagem do servidor
def enviar_msg_do_servidor(driver, servidor_enviar, usuario, caixa_de_pesquisa, caixa_msg, servidor_confirmar):
    try:
        agent = {"User-Agent": 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'}
        api = requests.get(servidor_enviar, params={'usuario': usuario}, headers=agent)
        time.sleep(1)
        api = api.text
        api = api.split(".n.")
        enviando = api[0].strip()
        if enviando == "enviando":
            contato_enviar = api[2].strip()
            mensagem_enviar = api[3].strip()
            
            caixa_de_pesquisa_element = driver.find_element(By.CSS_SELECTOR, caixa_de_pesquisa)
            caixa_de_pesquisa_element.send_keys(contato_enviar)
            caixa_de_pesquisa_element.send_keys(Keys.ENTER)
            
            message_box = driver.find_element(By.CSS_SELECTOR, caixa_msg)
            clipboard.copy(mensagem_enviar)
            message_box.send_keys(Keys.CONTROL, "v")
            message_box.send_keys(Keys.ENTER)
            webdriver.ActionChains(driver).send_keys(Keys.ESCAPE).perform()
            
            requests.get(servidor_confirmar, params={'id': api[1].strip()}, headers=agent)
    except Exception as e:
        print(f'Erro ao enviar mensagem do servidor: {e}')

def bot():
    # Configurações do Chrome
    dir_path = os.getcwd()
    chrome_options = Options()
    chrome_options.add_argument(f"user-data-dir={dir_path}/profile/zap")
    
    # Inicializa o WebDriver
    service = Service(executable_path='./chromedriver.exe')
    driver = webdriver.Chrome(service=service, options=chrome_options)
    
    driver.get('https://web.whatsapp.com/')
    
    # Obter configurações do WhatsApp
    chave = "x4klmOS8Xln6AAWlNU9ttz2LQLl4n7TM"  # Substitua pela sua chave
    bolinha_notificacao, contato_cliente, caixa_msg, msg_cliente, caixa_de_pesquisa, pega_contato = obter_configuracoes_whatsapp(chave)
    
    # Aguarde o WhatsApp Web carregar
    time.sleep(10)
    
    while True:
        try:
            # Abrir notificação
            bolinha_qt = abrir_notificacao(driver, bolinha_notificacao)
            if bolinha_qt:
                print(f'Notificações encontradas: {bolinha_qt}')
                
                # Pegar contato
                telefone_final = pega_contato(driver, contato_cliente)
                
                # Enviar mensagens para o servidor
                usuario = "seu_usuario"  # Substitua pelo seu usuário
                pagina = "sua_pagina"    # Substitua pela sua página
                envia_as_msg_para_servidor(driver, msg_cliente, telefone_final, usuario, pagina)
                
                # Enviar mensagem do servidor
                servidor_enviar = "servidor_enviar"  # Substitua pelo servidor de envio
                servidor_confirmar = "servidor_confirmar"  # Substitua pelo servidor de confirmação
                enviar_msg_do_servidor(driver, servidor_enviar, usuario, caixa_de_pesquisa, caixa_msg, servidor_confirmar)
        except Exception as e:
            print(f'Erro no bot: {e}')
        
        time.sleep(60)  # Aguarda um minuto antes de checar novamente

if __name__ == "__main__":
    bot()
