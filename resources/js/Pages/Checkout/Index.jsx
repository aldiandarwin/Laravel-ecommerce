import { useState } from 'react';
import AppLayout from '@/Layouts/AppLayout';
import PaymentMethod from '@/Pages/Checkout/Partials/PaymentMethod';
import Courier from '@/Pages/Checkout/Partials/Courier';
import ShippingInformation from '@/Pages/Checkout/Partials/ShippingInformation';
import ContactInformation from '@/Pages/Checkout/Partials/ContactInformation';
import { Head, router } from '@inertiajs/react';
import OrderSummary from '@/Pages/Checkout/Partials/OrderSummary';

const paymentMethods = [
    { id: 'bni', type: 'bank_transfer', title: 'BNI', description: 'BNI Virtual Account', method: 'bank' },
    { id: 'mandiri', type: 'echannel', title: 'Mandiri', description: 'Mandiri dengan Biller', method: 'bank' },
    { id: 'gopay', type: 'ewallet_gopay', title: 'Gopay', description: 'Gopay dengan QR Code', method: 'e-wallet' },
];

export default function Index() {
    const [selectedPaymentMethod, setSelectedPaymentMethod] = useState(paymentMethods[0]);
    const [selectedCourier, setSelectedCourier] = useState({});
    const [selectedService, setSelectedService] = useState({});
    const [services, setServices] = useState([]);

    function confirmOrder(e) {
        e.preventDefault();
        router.post(route('checkout.store'), {
            payment_method: selectedPaymentMethod,
            courier: selectedCourier,
            service: selectedService,
        });
    }
    return (
        <div>
            <Head title='Checkout' />
            <main className='mx-auto max-w-7xl px-4 pb-24 pt-16 sm:px-6 lg:px-8'>
                <div className='mx-auto max-w-2xl lg:max-w-none'>
                    <h1 className='sr-only'>Checkout</h1>

                    <form onSubmit={confirmOrder} className='lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16'>
                        <div>
                            <ContactInformation />
                            <ShippingInformation />
                            <Courier
                                {...{
                                    selectedService,
                                    setSelectedService,
                                    selectedCourier,
                                    setSelectedCourier,
                                    services,
                                    setServices,
                                }}
                            />
                            <PaymentMethod {...{ selectedPaymentMethod, setSelectedPaymentMethod, paymentMethods }} />
                        </div>

                        {/* Order summary */}
                        <OrderSummary shipping={selectedService?.cost} />
                    </form>
                </div>
            </main>
        </div>
    );
}

Index.layout = (page) => (
    <AppLayout
        header={<h2 className='text-xl font-semibold leading-tight text-slate-800'>Checkout</h2>}
        children={page}
    />
);
