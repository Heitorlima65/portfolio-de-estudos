using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace exercicioDia12do03
{
    internal class Cofre
    {
        public double saldo;
        public string senha = "1423";
        public string estado;
        public double saque;
        public Cofre()
        {
            estado = "fechado";
        }
        public void abrir(string senha)
        {
            if(senha == this.senha)
            {
                Console.WriteLine("senha correta, Cofre aberto!");
            }
            else
            {
                Console.WriteLine("senha errada, Cofre echado!");
            }
            if(estado == "aberto")
            {
                Console.WriteLine("cofre ja aberto");
                estado= "aberto";
            }
            else if(estado == "fechado")
            {
                Console.WriteLine("cofre aberto");
                estado = "aberto";
            }
            Console.ReadKey();
        }
        public void fechar(string senha)
        {
            if (senha == this.senha)
            {
                if (estado == "aberto")
                {
                    Console.WriteLine("cofre fechado");
                    estado = "fechado";
                }
                else if (estado == "fechado")
                {
                    Console.WriteLine("cofre ja fechado");
                    estado = "fechado";
                }
            }
            else
            {
                Console.WriteLine("senha errada!");
            }
            Console.ReadKey();
        }
        public void depositar(string senha)
        {  
            if(senha == this.senha)
            {
                Console.WriteLine("qual seria o valor a ser depositado?");
                int depositar = int.Parse(Console.ReadLine());
                saldo += depositar;
                Console.WriteLine("seu saldo atual é de:\t" + saldo);
            }
            else
            {
                Console.WriteLine("não foi possivel abrir o cofre, senha errada!");
            }
            Console.ReadKey();
        } 
        public void sacar(string senha)
        {
            if (senha == this.senha)
            {
                Console.WriteLine("qual é o valor a ser sacado?");
                saque = double.Parse(Console.ReadLine());
                if((saque == saldo) || (saque < saldo))
                {
                    Console.WriteLine("você sacou o valor de:\t" + saque);
                    saldo -= saque;
                }
                else
                {
                    Console.WriteLine("você não tem saldo suficiente para este saque!");
                }

            }
            else
            {
                Console.WriteLine("senha errada!");
            }
            Console.ReadKey();
        }
        public void VerSaldo(string senha)
        {
            if (senha == this.senha)
            {
                Console.WriteLine("seu saldo é de:\t" + saldo);
            }
            else
            {
                Console.WriteLine("senha errada!");
            }
            Console.ReadKey();
        }
    }
}
