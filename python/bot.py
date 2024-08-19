#import api_whatsapp
import editacodigo_whats
import time
import os

from api_whatsapp import abrir_notificacao

# PUXA AS CONFIGURAÇõES INICIAIS
#bolinha_notificacao, contato_cliente, caixa_msg, msg_cliente, caixa_de_pesquisa, pega_contato = api_whatsapp.obter_configuracoes_whatsapp('x4klmOS8Xln6AAWlNU9ttz2LQLl4n7TM')
bolinha_notificacao, contato_cliente, caixa_msg, msg_cliente, caixa_de_pesquisa, pega_contato = editacodigo_whats.obter_configuracoes_whatsapp('x4klmOS8Xln6AAWlNU9ttz2LQLl4n7TM')

# CARREGA NAVEGADOR
#driver = api_whatsapp.carregar_pagina_whatsapp('zap/sessao', 'https://web.whatsapp.com/')
driver = editacodigo_whats.carregar_pagina_whatsapp('zap/sessao', 'https://web.whatsapp.com/')

#time.sleep(120)

################ VARIÁVEIS ################
usuario = 'admin@teste.com'

pagina = 'http://localhost/BOT/api/recebe.php?'

servidor_enviar = 'http://localhost/BOT/api/enviar.php?'

servidor_confirmar = 'http://localhost/BOT/api/confirma.php?'

###########################################

while True:
    try:
        #notificao = api_whatsapp.abrir_notificacao(driver, bolinha_notificacao)
        notificao = editacodigo_whats.abrir_notificacao(driver, bolinha_notificacao)
        time.sleep(1)
        #telefone_final = api_whatsapp.pega_contato(driver, contato_cliente)
        telefone_final = editacodigo_whats.pega_contato(driver, contato_cliente)
        time.sleep(1)
        #final = api_whatsapp.envia_as_msg_para_servidor(driver, msg_cliente, telefone_final, usuario, pagina)
        final = editacodigo_whats.envia_as_msg_para_servidor(driver, msg_cliente, telefone_final, usuario, pagina)
    except:
        try:
            #envia = api_whatsapp.enviar_msg_do_servidor(driver, servidor_enviar, usuario, caixa_de_pesquisa, caixa_msg, servidor_confirmar)
            envia = editacodigo_whats.enviar_msg_do_servidor(driver, servidor_enviar, usuario, caixa_de_pesquisa, caixa_msg, servidor_confirmar)
            print(envia)
        except:
            print('aguarde')