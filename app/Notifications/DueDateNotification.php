<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DueDateNotification extends Notification
{
    use Queueable;
    protected $customer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('NOTIFIKASI JATUH TEMPO NASABAH : ' . $this->customer->nama_singkat)
                    ->greeting('NOTIFIKASI JATUH TEMPO')
                    ->line('NAMA NASABAH : ' . $this->customer->nama_singkat)
                    ->line('TANGGAL JATUH TEMPO : ' . date('d', strtotime($this->customer->tgl_jt)) . ' Bulan Berjalan')
                    ->line('Untuk mengunjungi halaman web, klik link dibawah ini')
                    ->action('Klik Disini', route('credit-collection.customer.index'))
                    ->line('Terima Kasih!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        //
    }
}
