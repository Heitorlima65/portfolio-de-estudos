
package com.mycompany.exibirinformacoescomlogin;

import java.util.Scanner;

public class Login {
    Scanner s = new Scanner(System.in);
    private String email, senha, emailDigitado, senhaDigitada;
    
    public String getEmail() {
        return email;
    }
    
    public void setEmail(String email) {
        this.email = email;
    }
    
    public String getSenha() {
        return senha;
    }
    
    public void setSenha(String senha) {
        this.senha = senha;
    }
    
    public void EfetuarCadastro (){
        System.out.print("por favor digite seu email:");
        email = s.nextLine();
        System.out.print("por favor digite sua senha:");
        senha = s.nextLine();
    }
    public void EfetuarLogin(){
        do{
            System.out.print("Por favor digite seu email cadastrado:");
            emailDigitado = s.nextLine();
            System.out.print("Agora digite a senha cadastrada:");
            senhaDigitada = s.nextLine();
            if((emailDigitado.equals(email)) && (senhaDigitada.equals(senha))){
                System.out.println("login efetuado, bem vindo(a)!");
                System.out.println("email: " + email);
                System.out.println("senha: " + senha);
            }
            else if((emailDigitado.equals(email)) && (!senhaDigitada.equals(senha))){
            System.out.println("A senha digitada e incorreta!");
            }
            else if((!emailDigitado.equals(email)) && (senhaDigitada.equals(senha))){
                System.out.println("Email digitado esta incorreto");
            }
            else{
                System.out.println("email e senha incorretos!");
            }
        }while(!(emailDigitado.equals(email)) && (senhaDigitada.equals(senha)));
    }
    
}

