import java.util.Scanner;

public class Bank {
    private int saldo;
    Scanner masukan = new Scanner(System.in);

    public Bank(int saldo) {
        this.saldo = saldo;
    }

    void simpanAwal() {
        System.out.println("Saldo awal adalah : Rp. " + saldo);
    }

    void simpanUang(int simpan) {
        simpan = masukan.nextInt();
        saldo = simpan + saldo;
        System.out.println("Saldo Anda Saat ini adalah Rp. " + saldo);
    }

    void ambilUang(int ambil) {
        ambil = masukan.nextInt();
        if (saldo <= ambil) {
            System.out.println("Maaf Saldo anda kurang");
        } else {
            saldo -= ambil;
            System.out.println("Saldo Anda saat ini adalah Rp. " + saldo);
        }
    }
}
