# endpoint dan data


### halaman dashboard login ke mikrotik (RouterController) endpoint '/dashboard'
kolom:

ip = '';
user = '';
pass = '';

### halaman generate voucher (GenerateController) endpoint '/gen'

name = generate dari form
password = generate dari form
Durasi = generate dari form
Paket Voucher = generate dari form
logo = generate dari form
profile = profile dari session


# API Documentation: RouterController & GenerateController

## 1. Login Dashboard MikroTik

### Endpoint  
`POST /dashboard`

### Deskripsi  
Endpoint ini digunakan untuk login ke dashboard RouterController pada MikroTik. Data yang diperlukan adalah alamat IP router, username, dan password.

### Request Parameters  
| Parameter | Tipe Data | Deskripsi                  | Contoh            |
|-----------|-----------|----------------------------|--------------------|
| `ip`      | `string`  | Alamat IP router MikroTik. | `"192.168.88.1"`  |
| `user`    | `string`  | Username untuk login.      | `"admin"`         |
| `pass`    | `string`  | Password untuk login.      | `"password123"`   |

### Contoh Request  
```json
POST /dashboard
{
  "ip": "192.168.88.1",
  "user": "admin",
  "pass": "password123"
}