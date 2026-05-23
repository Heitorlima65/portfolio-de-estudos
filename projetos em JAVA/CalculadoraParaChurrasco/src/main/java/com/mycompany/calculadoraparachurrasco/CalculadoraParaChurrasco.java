
package com.mycompany.calculadoraparachurrasco;

import java.util.Scanner;

public class CalculadoraParaChurrasco {

    public static void main(String[] args) {
        Scanner s = new Scanner(System.in);
        int nHomens, nMulheres, nCriancas;
        double qBebidas, qCarvao, qCarne;
        System.out.println("Bem vindo(a) à calculadora para churrasco!");
        System.out.println("vou fazer algumas perguntas:");
        System.out.print ("pressione qualquer tecla para continuar:");
        s.nextLine();
        System.out.print("quantos homens tem o churrasco:");
        nHomens = s.nextInt();
        System.out.print("quantas mulheres tem o churrasco:");
        nMulheres = s.nextInt();
        System.out.print("quantas crianças tem o churrasco:");
        nCriancas = s.nextInt();
        qCarne = (nHomens * 400 + nMulheres * 300 + nCriancas * 200) / 1000.0;
        qBebidas = (nHomens + nMulheres + nCriancas) * 2;
        qCarvao = qCarne * 2;
        System.out.println("Seu churrasco vai precisar de " +
                            qCarne + "kg de carne " +
                            qBebidas + " unidades de bebidas " +
                            qCarvao + "kg de carvao");
        
        
    }
}
