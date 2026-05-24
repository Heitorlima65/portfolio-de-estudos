
package com.mycompany.exibirinformacoescomlogin;

import java.util.Scanner;

public class ExibirInformacoesComLogin {

    public static void main(String[] args) {
        Scanner s = new Scanner(System.in);
        Login l = new Login();
        System.out.println("bem vindo ao nosso sistema, para comecar faca seu cadastro!");
        l.EfetuarCadastro();
        System.out.println("agora faca seu login!");
        l.EfetuarLogin();
    }
}
