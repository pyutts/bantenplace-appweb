<?php

require_once ROOTPATH . 'vendor/autoload.php';

use Xendit\Xendit;
use Xendit\Invoices;

function initXendit()
{
    $apiKey = getenv('XENDIT_API_KEY');
    if (!$apiKey) {
        log_message('error', 'Xendit API Key not found');
        return false;
    }
    
    Xendit::setApiKey($apiKey);
    return true;
}

function createInvoice($params)
{
    if (!initXendit()) {
        return false;
    }
    
    log_message('debug', 'Creating Xendit Invoice with params: ' . json_encode($params));
    
    $amount = (int) str_replace(['Rp', '.', ','], '', $params['amount']);
    if (!$amount) {
        log_message('error', 'Invalid amount format');
        return false;
    }
    
    $invoice = Invoices::create([
        'external_id' => $params['order_id'],
        'amount' => $amount,
        'description' => 'Payment for Order #' . $params['order_id'],
        'invoice_duration' => 86400,
        'customer' => [
            'given_names' => $params['customer_name'],
            'email' => $params['customer_email'],
            'mobile_number' => $params['customer_phone']
        ],
        'success_redirect_url' => base_url('checkout/success'),
        'failure_redirect_url' => base_url('checkout/failed'),
        'currency' => 'IDR'
    ]);
    
    log_message('debug', 'Xendit Invoice Response: ' . json_encode($invoice));
    
    return $invoice;
} 