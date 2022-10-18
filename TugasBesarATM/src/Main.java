import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        int ambil = 0, simpan = 0;
        Scanner pilih = new Scanner(System.in);

        // saldo awal
        Bank bk = new Bank(100000);

        System.out.println("Selamat Datang di BANK BAGUS");
        for (int i = 1; i >= 1; i++) {
            System.out.println("\n>> Menu ATM <<");
            System.out.println("1. Cek Saldo \n2. Simpan Uang \n3. Ambil Uang \n0. Keluar");
            System.out.println("Pilih Menu ATM : ");
            int menu = pilih.nextInt();
            if (menu == 1) {
                bk.simpanAwal();
            } else if (menu == 2) {
                System.out.println("Masukan Uang disimpan Rp. ");
                bk.simpanUang(simpan);
            } else if (menu == 3) {
                System.out.println("Masukan Uang diambil Rp. ");
                bk.ambilUang(ambil);
            } else if (menu > 3) {
                System.out.println("Menu Tidak Ada");
                System.out.println("Ulangi Pilih Menu ATM");
            } else {
                System.out.println("Terimakasih telah menggunakan layanan ATM kami");
                break;
            }
        }
    }
}