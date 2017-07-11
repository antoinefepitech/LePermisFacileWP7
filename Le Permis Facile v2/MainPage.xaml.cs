using System;
using Microsoft.Phone.Shell;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Animation;
using System.Windows.Shapes;
using Microsoft.Phone.Controls;
using System.Data;
using System.Xml.Linq;
using System.Data.Linq;
using System.IO;

using System.IO.IsolatedStorage;

using System.Windows.Media.Effects;
namespace Le_Permis_Facile_v2
{
    public partial class MainPage : PhoneApplicationPage
    {
        // Constructor
        public MainPage()
        {
            InitializeComponent();

            // Set the data context of the listbox control to the sample data
            DataContext = App.ViewModel;
            this.Loaded += new RoutedEventHandler(MainPage_Loaded);
        }

        // Load data for the ViewModel Items
        private void MainPage_Loaded(object sender, RoutedEventArgs e)
        {
            if (!App.ViewModel.IsDataLoaded)
            {
                App.ViewModel.LoadData();
            }
        }
        //Variables déclarations !

        int nombreDeTestRealiser;
        int bestScoring;
        int moyenneScoring;
        int[] recentTest;
        string[] recentTestStr;
        string[] Globale;
        bool TestExame;
        bool CorexExam;
        string session;
        int QuestionEnCours;
        string[] questionX;
        string[] questionCorex;
        bool As;
        bool Bs;
        bool Cs;
        bool Ds;
        int point;
       Color c = new Color();
       Color n = new Color();
       Color good = new Color();
       Color lose = new Color();
    
           
        private void assignObjet()//Cette fonction assigne les valeur des variable au label
        {

          /*  globalTest.Text = nombreDeTestRealiser.ToString();
            heigtScoring.Text = bestScoring.ToString();
            scoreMoyen.Text = moyenneScoring.ToString();
           * */
            c.A =   137;
            c.B = 17;
            c.G = 17;
            c.A = 100;
            n.A = 0;

            good.B = 63;
            good.G = 199;
            good.R = 142;
            good.A = 100;
         

            lose.B = 126;
            lose.G= 109;
            lose.R = 249;
            lose.A = 100;





        }



       
        private void phraseMagic()
        {

           


        }

        private void variableCharge()//cette fonction servira plus tard pour charger les donner du stockage
        {
            LLS.Items.Clear();
            SerieCount.Items.Clear();
            noteRec1.Text = "";
            noteRec2.Text = "";
            noteRec3.Text = "";
            noteRec4.Text = "";
            good1.Visibility = System.Windows.Visibility.Collapsed;
            good2.Visibility = System.Windows.Visibility.Collapsed;
            good3.Visibility = System.Windows.Visibility.Collapsed;
            good4.Visibility = System.Windows.Visibility.Collapsed;
            heightScoring1.Text = "";
            heightScoring2.Text = "";
            heightScoring3.Text = "";
            heightScoring4.Text = "";
            globalTest.Text = "";
            heigtScoring.Text = "";
            scoreMoyen.Text = "";
            moyenneScoring = 0;
            bestScoring = 0;


            IsolatedStorageFile file = IsolatedStorageFile.GetUserStoreForApplication();
            XDocument loadedData;
            
            if (file.FileExists("DATA.xml"))
            {

                using (IsolatedStorageFileStream stream = file.OpenFile("DATA.xml", System.IO.FileMode.Open))
                {
                    loadedData = XDocument.Load(stream);
                 
                  
                }
            }
            else
            {
                loadedData = XDocument.Load("DATA.xml");
            }
            var reference = from x in loadedData.Descendants("data") select x;
         
            int total = -1;
            moyenneScoring = 0;
         
        
            Globale = new string[reference.Count<Object>() - 1];
            int LaTotal = reference.Count<Object>() - 1;
            recentTest = new int[5];
            recentTestStr = new string[5];
            string test = "";
    
            foreach (var elem in reference)
            {
                total++;
                if (total > 0)
                {

                    string TheScore = elem.Element("note").Value.ToString();
            

                    if (total == 1)
                        bestScoring = Convert.ToInt32(elem.Element("note").Value);
                    else if (Convert.ToInt32(elem.Element("note").Value) > bestScoring)
                        bestScoring = Convert.ToInt32(elem.Element("note").Value);

                    

                    string txt;
                    string serie;
                    
                    txt = "Test " + elem.Element("serie").Value + " N°" + elem.Element("numeroSerie").Value;
                    serie = " Serie " + elem.Element("serie").Value;
                    txt += " du " + elem.Element("date").Value;
                    txt += "   " + elem.Element("note").Value + "/40";
                    Globale[LaTotal - total] = txt;
                    txt = txt.Replace("\n", "");

              
                    if (test != serie)
                    {


                        TextBlock txtB3 = new TextBlock();
                        txtB3.FontSize = 30;
                        txtB3.FontWeight = FontWeights.Bold;
                        txtB3.Text = serie;
                        txtB3.Foreground = new SolidColorBrush(Colors.White);
                        SerieCount.Items.Add(txtB3);
                    }


                    test = serie;


                    TextBlock txtB4 = new TextBlock();
                    txtB4.Text = txt;
                    txtB4.Foreground = new SolidColorBrush(Colors.White);
                    txtB4.FontSize = 24;
                    SerieCount.Items.Add(txtB4);



                    TextBlock txtB = new TextBlock();
                    txtB.FontSize = 30;
                    txtB.FontWeight = FontWeights.Bold;
                    txtB.Foreground = new SolidColorBrush(Colors.White);
                    txtB.Text = serie;
                    LLS.Items.Add(txtB);



                    TextBlock txtB2 = new TextBlock();
                    txtB2.Text = txt;
                    txtB2.Foreground = new SolidColorBrush(Colors.White);
                    txtB2.FontSize = 24;
                    LLS.Items.Add(txtB2);


                    moyenneScoring += Convert.ToInt32(elem.Element("note").Value);

                    if (LaTotal - total <=4)
                    {
                        recentTest[LaTotal  - total] = Convert.ToInt32(elem.Element("note").Value);
                        recentTestStr[LaTotal - total] = txt;
                    }



                }

            }


            int z = 0;

            foreach (string elem in recentTestStr)
            {
                z++;
                

                switch (z)
                {

                    case 1:

                        heightScoring1.Text = elem;
                        noteRec1.Text = recentTest[z - 1].ToString();
                        if (recentTest[z - 1] >= 35)
                            good1.Visibility = System.Windows.Visibility.Visible;
                        break;

                    case 2:
                        heightScoring2.Text = elem;
                        noteRec2.Text = recentTest[z - 1].ToString();
                        if (recentTest[z - 1] >= 35)
                            good2.Visibility = System.Windows.Visibility.Visible;
                        break;

                    case 3:
                        heightScoring3.Text = elem;
                        noteRec3.Text = recentTest[z - 1].ToString();
                        if (recentTest[z - 1] >= 35)
                            good3.Visibility = System.Windows.Visibility.Visible;
                        break;

                    case 4:
                        heightScoring4.Text = elem;
                        noteRec4.Text = recentTest[z - 1].ToString();
                        if (recentTest[z - 1] >= 35)
                            good4.Visibility = System.Windows.Visibility.Visible;
                        break;






                }



            }



            heigtScoring.Text = bestScoring.ToString() + "/40";
            if (total > 0)
                moyenneScoring = moyenneScoring / total;

            globalTest.Text = total.ToString();
            scoreMoyen.Text = moyenneScoring.ToString() + "/40";
            phraseMagic();
        }

        private void start_party_Click(object sender, RoutedEventArgs e)
        {
            if (serieCode.Text.Trim() != "" && serieNumber.Text.Trim() != "")
            {
                if (serieCode.Text.Length < 2)
                    serieCode.Text = 0 + serieCode.Text;
                if (serieNumber.Text.Length < 2)
                    serieNumber.Text = 0 + serieNumber.Text;
                session = serieCode.Text + " " + serieNumber.Text;
                QuestionEnCours = 1;
                TestExame = true;
                point = 0;
               (ApplicationBar.Buttons[0] as ApplicationBarIconButton).IsEnabled = true;
              start_exam.Visibility = System.Windows.Visibility.Collapsed;
              examen.Visibility = System.Windows.Visibility.Visible;
              (ApplicationBar.MenuItems[0] as ApplicationBarMenuItem).IsEnabled = false;
         
                curenttest.Text = QuestionEnCours.ToString();
                questionX = new string[40];
            }
            else
            {
                MessageBox.Show("Merci d'indiquer la série du questionnaire");
            }


        }

        private void Button_Click_1(object sender, RoutedEventArgs e)
        {


            if (!As)
            {
                As = true;               
                Abtn.Background = new SolidColorBrush(c);
            }
            else
            {
                As = false;
                Abtn.Background = new SolidColorBrush(n);

            }
        }

        private void Bbtn_Click(object sender, RoutedEventArgs e)
        {
            if (!Bs)
            {
                Bs = true;
                Bbtn.Background = new SolidColorBrush(c);
            }
            else
            {
                Bs = false;
                Bbtn.Background = new SolidColorBrush(n);

            }
        }

        private void Cbtn_Click(object sender, RoutedEventArgs e)
        {
            if (!Cs)
            {
                Cs = true;
                Cbtn.Background = new SolidColorBrush(c);
            }
            else
            {
                Cs = false;
                Cbtn.Background = new SolidColorBrush(n);

            }
        }

        private void Dbtn_Click(object sender, RoutedEventArgs e)
        {
            if (!Ds)
            {
                Ds = true;
                Dbtn.Background = new SolidColorBrush(c);
            }
            else
            {
                Ds = false;
                Dbtn.Background = new SolidColorBrush(n);

            }
        }

        private void NextQuestion_Click(object sender, RoutedEventArgs e)
        {
            string stringtemporyVar = "";
            if (QuestionEnCours <= 40)
            {
                if (As)
                {
                    stringtemporyVar += "a";


                }

                if (Bs)
                {
                    stringtemporyVar += "b";

                }

                if (Cs)
                {
                    stringtemporyVar += "c";

                }

                if (Ds)
                {
                    stringtemporyVar += "d";

                }
                questionX[QuestionEnCours - 1] = stringtemporyVar;

                Abtn.Background = new SolidColorBrush(n);
                Bbtn.Background = new SolidColorBrush(n);
                Cbtn.Background = new SolidColorBrush(n);
                Dbtn.Background = new SolidColorBrush(n);
                As = false;
                Bs = false;
                Cs = false;
                Ds = false;

                if (QuestionEnCours + 1 == 40)
                {
                    NextQuestion.Content = "Passer à la correction";

                }
                if (QuestionEnCours < 40)
                {
                    QuestionEnCours++;
                    curenttest.Text = QuestionEnCours.ToString();
                }
                else
                {
                   examen.Visibility = System.Windows.Visibility.Collapsed;
                    correction.Visibility = System.Windows.Visibility.Visible;
                    QuestionEnCours = 1;
                    TestExame = false;
                    CorexExam = true;
                    As = false;
                    Bs = false;
                    Cs = false;
                    Ds = false;
                   currentcorex.Text = QuestionEnCours.ToString();
                    questionCorex = new string[40];
                    verifGoodOrLose();
                }




            }




        }

        private void Correction_Loaded(object sender, RoutedEventArgs e)
        {


        }

        private void validCorrex_Click(object sender, RoutedEventArgs e)
        {
            A1.Foreground = new SolidColorBrush(lose);
            A1.Visibility = System.Windows.Visibility.Collapsed;
            A1.FontWeight = FontWeights.Normal;

            B1.Foreground = new SolidColorBrush(lose);
            B1.Visibility = System.Windows.Visibility.Collapsed;
            B1.FontWeight = FontWeights.Normal;

            C1.Foreground = new SolidColorBrush(lose);
            C1.Visibility = System.Windows.Visibility.Collapsed;
            C1.FontWeight = FontWeights.Normal;


            D1.Foreground = new SolidColorBrush(lose);
            D1.Visibility = System.Windows.Visibility.Collapsed;
            D1.FontWeight = FontWeights.Normal;


            string stringtemporyVar = "";
            if (QuestionEnCours <= 40)
            {
                if (As)
                {
                    stringtemporyVar += "a";


                }

                if (Bs)
                {
                    stringtemporyVar += "b";

                }

                if (Cs)
                {
                    stringtemporyVar += "c";

                }

                if (Ds)
                {
                    stringtemporyVar += "d";

                }
                questionCorex[QuestionEnCours - 1] = stringtemporyVar;


                As = false;
                Bs = false;
                Cs = false;
                Ds = false;

                if (QuestionEnCours + 1 == 40)
                {
                    validCorrex.Content = "Voir résultats";

                }

                if (QuestionEnCours < 40)
                {
                    QuestionEnCours++;
                    A1btn.Background = new SolidColorBrush(n);
                    B1btn.Background = new SolidColorBrush(n);
                    C1btn.Background = new SolidColorBrush(n);
                    D1btn.Background = new SolidColorBrush(n);
                    verifGoodOrLose();
                    currentcorex.Text = QuestionEnCours.ToString();
                }
                else
                {
                    Resultat();
                    correction.Visibility = System.Windows.Visibility.Collapsed;
                    start_exam.Visibility = System.Windows.Visibility.Visible;
                    NextQuestion.Content = "QUESTION SUIVANTE";
                    (ApplicationBar.Buttons[0] as ApplicationBarIconButton).IsEnabled = false;
                    (ApplicationBar.MenuItems[0] as ApplicationBarMenuItem).IsEnabled = true;
              

                }



            }






        }

        private void Resultat()
        {

            for (int i = 0; i < 40; i++)
            {

                if (questionCorex[i] == questionX[i])
                {
                    point++;
                }


            }
            MessageBox.Show("Vous avez un score de " + point.ToString() + "/40");

          //  Correction.Visibility = System.Windows.Visibility.Collapsed;
          //  start_exam.Visibility = System.Windows.Visibility.Visible;
            adding();


        }

        private void verifGoodOrLose()
        {


            if (questionX[QuestionEnCours - 1].Contains("a"))
            {
                A1.Visibility = System.Windows.Visibility.Visible;
                A1btn.Background = new SolidColorBrush(lose);

            }
            if (questionX[QuestionEnCours - 1].Contains("b"))
            {
                B1.Visibility = System.Windows.Visibility.Visible;
                B1btn.Background = new SolidColorBrush(lose);

            }
            if (questionX[QuestionEnCours - 1].Contains("c"))
            {
                C1.Visibility = System.Windows.Visibility.Visible;
                C1btn.Background = new SolidColorBrush(lose);

            }
            if (questionX[QuestionEnCours - 1].Contains("d"))
            {
                D1.Visibility = System.Windows.Visibility.Visible;
                D1btn.Background = new SolidColorBrush(lose);

            }

        }

        private void A1btn_Click_1(object sender, RoutedEventArgs e)
        {
            if (!As)
            {

                if (questionX[QuestionEnCours - 1].Contains("a"))
                {

                    A1.Foreground = new SolidColorBrush(good);
                    A1btn.Background = new SolidColorBrush(good);
                    As = true;
                }
                else
                {

                    A1.Visibility = System.Windows.Visibility.Visible;
                    A1.Foreground = new SolidColorBrush(lose);
                    A1.FontWeight = FontWeights.Bold;
                    A1btn.Background = new SolidColorBrush(lose);
                    As = true;

                }
            }
            else
            {

                if (questionX[QuestionEnCours - 1].Contains("a"))
                {

                    A1.Foreground = new SolidColorBrush(lose);
                    A1btn.Background = new SolidColorBrush(lose);
                    As = false;
                }
                else
                {
                    A1.Foreground = new SolidColorBrush(lose);
                    A1.Visibility = System.Windows.Visibility.Collapsed;
                    A1btn.Background = new SolidColorBrush(n);
                    As = false;
                }

            }

        }

        private void B1btn_Click(object sender, RoutedEventArgs e)
        {
            if (!Bs)
            {

               if (questionX[QuestionEnCours - 1].Contains("b"))
                {

                    B1.Foreground = new SolidColorBrush(good);
                    B1btn.Background = new SolidColorBrush(good);
                    Bs = true;
                }
                else
                {

                    B1.Visibility = System.Windows.Visibility.Visible;
                    B1.Foreground = new SolidColorBrush(lose);
                    B1.FontWeight = FontWeights.Bold;
                    B1btn.Background = new SolidColorBrush(lose);
                    Bs = true;

                }
            }
            else
            {

                if (questionX[QuestionEnCours - 1].Contains("b"))
                {

                    B1.Foreground = new SolidColorBrush(lose);
                    B1btn.Background = new SolidColorBrush(lose);
                    Bs = false;
                }
                else
                {
                    B1.Foreground = new SolidColorBrush(lose);
                    B1.Visibility = System.Windows.Visibility.Collapsed;
                    B1btn.Background = new SolidColorBrush(n);
                    Bs = false;
                }

            }
        }

        private void C1btn_Click(object sender, RoutedEventArgs e)
        {
            if (!Cs)
            {

                if (questionX[QuestionEnCours - 1].Contains("c"))
                {

                    C1.Foreground = new SolidColorBrush(good);
                    C1btn.Background = new SolidColorBrush(good);
                    Cs = true;
                }
                else
                {

                    C1.Visibility = System.Windows.Visibility.Visible;
                    C1.Foreground = new SolidColorBrush(lose);
                    C1.FontWeight = FontWeights.Bold;
                    C1btn.Background = new SolidColorBrush(lose);
                    Cs = true;

                }
            }
            else
            {

                if (questionX[QuestionEnCours - 1].Contains("c"))
                {

                    C1.Foreground = new SolidColorBrush(lose);
                    C1btn.Background = new SolidColorBrush(lose);
                    Cs = false;
                }
                else
                {
                    C1.Foreground = new SolidColorBrush(lose);
                    C1.Visibility = System.Windows.Visibility.Collapsed;
                    C1btn.Background = new SolidColorBrush(n);
                    Cs = false;
                }

            }
        }

        private void D1btn_Click(object sender, RoutedEventArgs e)
        {
            if (!Ds)
            {

                if (questionX[QuestionEnCours - 1].Contains("d"))
                {

                    D1.Foreground = new SolidColorBrush(good);
                    D1btn.Background = new SolidColorBrush(good);
                   Ds = true;
                }
                else
                {

                    D1.Visibility = System.Windows.Visibility.Visible;
                    D1.Foreground = new SolidColorBrush(lose);
                    D1.FontWeight = FontWeights.Bold;
                    D1btn.Background = new SolidColorBrush(lose);
                    Ds = true;

                }
            }
            else
            {

                if (questionX[QuestionEnCours - 1].Contains("d"))
                {

                    D1.Foreground = new SolidColorBrush(lose);
                    D1btn.Background = new SolidColorBrush(lose);
                    Ds = false;
                }
                else
                {
                    D1.Foreground = new SolidColorBrush(lose);
                    D1.Visibility = System.Windows.Visibility.Collapsed;
                    D1btn.Background = new SolidColorBrush(n);
                    Ds = false;
                }

            }



        }


        private void adding()
        {

            IsolatedStorageFile file = IsolatedStorageFile.GetUserStoreForApplication();
            XDocument loadedData;

            if (file.FileExists("DATA.xml"))
                using (IsolatedStorageFileStream stream = file.OpenFile("DATA.xml", System.IO.FileMode.Open))
                {
                    loadedData = XDocument.Load(stream);
                }
            else
            {
                loadedData = XDocument.Load("DATA.xml");
            }

            if (serieCode.Text.Length == 1) { serieCode.Text = "0" + serieCode.Text; };
            if (serieNumber.Text.Length == 1) { serieNumber.Text = "0" + serieNumber.Text; };
    
            var root = new XElement("data");
            var Date = new XElement("date", DateTime.Today.Date.ToShortDateString());
            var Serie = new XElement("serie", serieCode.Text);
            var numero = new XElement("numeroSerie", serieNumber.Text);
            var note = new XElement("note", point.ToString());
           
            root.Add(Date, Serie, note, numero);
            loadedData.Root.Add(root);

            using (IsolatedStorageFileStream stream = file.CreateFile("DATA.xml"))
            {
                loadedData.Save(stream);
            }


            variableCharge();




        }
        private void addingManuel()
        {

            IsolatedStorageFile file = IsolatedStorageFile.GetUserStoreForApplication();
            XDocument loadedData;

            if (file.FileExists("DATA.xml"))
                using (IsolatedStorageFileStream stream = file.OpenFile("DATA.xml", System.IO.FileMode.Open))
                {
                    loadedData = XDocument.Load(stream);
                }
            else
            {
                loadedData = XDocument.Load("DATA.xml");
            }

            if (serie.Text.Length == 1) { serie.Text = "0" + serie.Text; };
            if (number.Text.Length == 1) { number.Text = "0" + serie.Text; };
            var root = new XElement("data");
            var Date = new XElement("date", DateTime.Today.Date.ToShortDateString());
            var Serie = new XElement("serie", serie.Text);
            var numero = new XElement("numeroSerie", number.Text);
            var note = new XElement("note", score.Text);
          
            root.Add(Date, Serie, note, numero);
            loadedData.Root.Add(root);

            using (IsolatedStorageFileStream stream = file.CreateFile("DATA.xml"))
            {
                loadedData.Save(stream);
            }


            variableCharge();




        }
        public class Data
        {
            public string Title { get; set; }
            public string Details { get; set; }
        }

        private void LayoutRoot_Loaded(object sender, RoutedEventArgs e)
        {
            variableCharge();
        }

        private void Button_MouseLeave_1(object sender, System.Windows.Input.MouseEventArgs e)
        {
           // start_exam1.Background = start_exam1.Background;
        }

        private void Button_MouseLeave_1(object sender, System.Windows.Input.MouseButtonEventArgs e)
        {
           // start_exam1.Background = start_exam1.Background;
        }

        private void start_exam1_MouseLeftButtonDown(object sender, System.Windows.Input.MouseButtonEventArgs e)
        {
           // start_exam1.Background = start_exam1.Background;
        }

        private void PhoneApplicationPage_Loaded(object sender, RoutedEventArgs e)
        {
            variableCharge();
            assignObjet();
        }

        private void addManuel_Click(object sender, RoutedEventArgs e)
        {
            addingManuel();
         
        }

        private void exit_Click(object sender, EventArgs e)
        {
            if (examen.Visibility == System.Windows.Visibility.Visible || correction.Visibility == System.Windows.Visibility.Visible)
            {

                if (MessageBox.Show("Voulez vous vraiment arrêter votre test ?", "Arrêt du text", MessageBoxButton.OKCancel) == MessageBoxResult.OK)
                {
                    examen.Visibility = System.Windows.Visibility.Collapsed;
                    correction.Visibility = System.Windows.Visibility.Collapsed;
                    start_exam.Visibility = System.Windows.Visibility.Visible;
              
                    NextQuestion.Content = "QUESTION SUIVANTE";
                    (ApplicationBar.Buttons[0] as ApplicationBarIconButton).IsEnabled = false;
                    (ApplicationBar.MenuItems[0] as ApplicationBarMenuItem).IsEnabled = true;
                    
                }

            
            }


        }

        private void PivotItem_Loaded(object sender, RoutedEventArgs e)
        {
            /*
            barState.IsVisible = true;
            Rei.IsEnabled = true;
            Exit.IsEnabled = false;
             */


        }

        private void Rei_Click(object sender, EventArgs e)
        {
            if (MessageBox.Show("Cette action va réinitialiser, l'application et éffacer tous les tests réalisés. Continuer ?", "Réinitilisation", MessageBoxButton.OKCancel) == MessageBoxResult.OK)
            {

                IsolatedStorageFile file = IsolatedStorageFile.GetUserStoreForApplication();
                XDocument loadedData;

                if (file.FileExists("DATA.xml"))
                    using (IsolatedStorageFileStream stream = file.OpenFile("DATA.xml", System.IO.FileMode.Open))
                    {
                        loadedData = XDocument.Load(stream);
                    }
                else
                {
                    loadedData = XDocument.Load("DATA.xml");
                }

                loadedData.Root.RemoveAll();
          

                using (IsolatedStorageFileStream stream = file.CreateFile("DATA.xml"))
                {
                    loadedData.Save(stream);
                }


                var root = new XElement("data");
                var Date = new XElement("date", "");
                var Serie = new XElement("serie", "");
                var numero = new XElement("numeroSerie", "");
                var note = new XElement("note", "");
                root.Add(Date, Serie, note, numero);
                loadedData.Root.Add(root);

                using (IsolatedStorageFileStream stream = file.CreateFile("DATA.xml"))
                {
                    loadedData.Save(stream);
                }


                variableCharge();
            }
        }

        private void Button_Click(object sender, RoutedEventArgs e)
        {
            
        }

        private void start_exam_Loaded(object sender, RoutedEventArgs e)
        {

        }

        private void serie_TextChanged(object sender, TextChangedEventArgs e)
        {

        }

   







    }
}