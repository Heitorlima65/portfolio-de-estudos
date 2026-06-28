using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;
using System.Timers;

namespace Tamagochi
{
    internal abstract class Tamagochi
    {
        private string nome;
        private int alimentacao;
        private int hidratacao;
        private int felicidade;
        private int energia;
        private int limpeza;
        private int saude;
        private string animalEscolha;
        private bool atualizarTela = true;

        public Tamagochi(int alimentacao, int hidratacao, int felicidade, int energia, int limpeza, int saude)
        {
            this.Alimentacao=alimentacao;
            this.Hidratacao=hidratacao;
            this.Felicidade=felicidade;
            this.Energia=energia;
            this.Limpeza=limpeza;
            this.Saude=saude;
        }
        public string Nome { get => nome; set => nome=value; }
        public int Alimentacao { get => alimentacao; set => alimentacao = Math.Clamp(value, 0, 100); }
        public int Hidratacao { get => hidratacao; set => hidratacao = Math.Clamp(value, 0, 100); }
        public int Felicidade { get => felicidade; set => felicidade = Math.Clamp(value, 0, 100); }
        public int Energia { get => energia; set => energia = Math.Clamp(value, 0, 100); }
        public int Limpeza { get => limpeza; set => limpeza = Math.Clamp(value, 0, 100); }
        public int Saude { get => saude; set => saude = Math.Clamp(value, 0, 100); }
        public string AnimalEscolha { get => animalEscolha; set => animalEscolha=value; }
        public bool AtualizarTela { get => atualizarTela; set => atualizarTela=value; }

        public virtual void FazerSom()
        {
            
        }
        public virtual void OpcaoFazerSom()
        {

        }

        public void MostrarStatus(int alimentacao, int hidratacao, int felicidade, int energia, int limpeza, int saude)
        {
            Thread.Sleep(1000);
            Console.Clear();
            Console.WriteLine(AnimalEscolha);
            Console.WriteLine($"Alimentação: {this.Alimentacao}%");
            Console.WriteLine($"Hidratação: {this.Hidratacao}%");
            Console.WriteLine($"Felicidade: {this.Felicidade}%");
            Console.WriteLine($"Energia: {this.Energia}%");
            Console.WriteLine($"Limpeza: {this.Limpeza}%");
            Console.WriteLine($"Saúde: {this.Saude}%"); 
        }

        public void Alimentar()
        {
            if (this.Alimentacao == 100)
            {
                Console.Clear();
                Console.WriteLine($"{Nome} está cheio!");
                Thread.Sleep(3000);
                Console.Clear();
            }
            else
            {
                Console.Clear();
                Console.WriteLine($"{Nome} está se alimentando...");
                Thread.Sleep(3000);
                Console.Clear();
                this.Alimentacao+=25;
                this.Felicidade+=25;
                this.Energia+=15;
                this.Limpeza-=5;
                this.Saude+=5;
            }
        }

        public void BeberAgua()
        {
            if (this.Hidratacao == 100)
            {
                Console.Clear();
                Console.WriteLine($"{Nome} está sem sede.");
                Thread.Sleep(3000);
                Console.Clear();
            }
            else
            {
                Console.Clear();
                Console.WriteLine($"{Nome} está bebendo água...");
                Thread.Sleep(3000);
                Console.Clear();
                this.Hidratacao+=25;
                this.Felicidade+=25;
                this.Saude+=5;
            }
        }

        public void Brincar()
        {
            if (this.Felicidade == 100)
            {
                Console.Clear();
                Console.WriteLine($"{Nome} não quer mais brincar.");
                Thread.Sleep(3000);
                Console.Clear();
            }
            else
            {
                Console.Clear();
                Console.WriteLine($"{Nome} está brincando...");
                Thread.Sleep(3000);
                Console.Clear();
                this.Felicidade+=25;
                this.Energia-=20;
                this.Alimentacao-=15;
                this.Hidratacao-=15;
                this.Limpeza-=15;
            }
        }

        public void Dormir()
        {
            if (this.Energia == 100)
            {
                Console.Clear();
                Console.WriteLine($"{Nome} não quer mais dormir");
                Thread.Sleep(3000);
                Console.Clear();
            }
            else
            {
                Console.Clear();
                Console.WriteLine($"{Nome} está dormindo...");
                Thread.Sleep(3000);
                Console.Clear();
                this.Energia+=50;
                this.Alimentacao-=25;
                this.Hidratacao-=25;
                this.Saude+=5;
            }
        }

        public void TomarBanho()
        {
            if (this.Limpeza == 100)
            {
                Console.Clear();
                Console.WriteLine($"{Nome} já está completamente limpo.");
                Thread.Sleep(3000);
                Console.Clear();
            }
            else
            {
                Console.Clear();
                Console.WriteLine($"{Nome} está tomando banho...");
                Thread.Sleep(3000);
                Console.Clear();
                this.Limpeza+=50;
                this.Felicidade+=25;
                this.Energia+=10;
            }
        }

        public void TomarRemedio()
        {
            if (this.Saude == 100)
            {
                Console.Clear();
                Console.WriteLine($"{Nome} está completamente saudável!");
                Thread.Sleep(3000);
                Console.Clear();
            }
            else
            {
                Console.Clear();
                Console.WriteLine($"{Nome} está tomando remédio...");
                Thread.Sleep(3000);
                Console.Clear();
                this.Saude+=50;
                this.Hidratacao+=5;
                this.Felicidade-=25;
            }
        }
        //sender, Ele representa a referência do objeto que disparou o evento
        //ElapsedEventArgs e, é a classe que contém os dados do evento sempre que um temporizador (System.Timers.Timer) é disparado.
        //          |
        //          |
        //          V

        public void AcabarTempo(object sender, ElapsedEventArgs e)
        {
            this.Alimentacao -= 5;
            this.Hidratacao -= 5;
            this.Felicidade -= 1;
            this.Energia -= 3;
            this.Limpeza -= 2;
            this.Saude -= 4;
            atualizarTela = true;
        }

        
    }
}
