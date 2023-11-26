import AppLayout from '@/Layouts/AppLayout';
import { Head, Link } from '@inertiajs/react';
import Container from '@/Components/Container';

export default function Index({ shipping_addresses }) {
    return (
        <div>
            <Head title='Shipping Address' />
            <Container>
                <div className='py-8'>
                    <div className='max-w-xl'>
                        <div className='mb-6 flex justify-end'>
                            <Link href={route('shipping-addresses.create')} className='text-blue-500 underline'>
                                New Shipping Address
                            </Link>
                        </div>
                        {shipping_addresses.length > 0 ? (
                            <div className='space-y-2'>
                                {shipping_addresses.map((shippingAddress) => (
                                    <div className='bg-white p-4 shadow sm:rounded-lg sm:p-6' key={shippingAddress.id}>
                                        <div className='flex items-center justify-between'>
                                            {shippingAddress.address}
                                        </div>

                                        <div className='mt-5 flex items-center gap-x-3'>
                                            <span>{shippingAddress.province}</span>
                                            <span className='text-gray-300'>/</span>
                                            <span>{shippingAddress.city}</span>
                                            <span className='text-gray-300'>/</span>
                                            <span>{shippingAddress.subdistrict}</span>
                                        </div>

                                        <div className='mt-4 flex items-center justify-between'>
                                            {shippingAddress.is_default ? (
                                                <p className='text-slate-500'>The default shipping address.</p>
                                            ) : (
                                                <span />
                                            )}

                                            <div className='flex gap-x-3'>
                                                <Link
                                                    as='button'
                                                    method='delete'
                                                    href={route('shipping-addresses.destroy', [shippingAddress])}
                                                    className='text-red-500 underline'>
                                                    Delete
                                                </Link>
                                                <Link
                                                    href={route('shipping-addresses.edit', [shippingAddress])}
                                                    className='text-blue-500 underline'>
                                                    Edit
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        ) : (
                            <div className='bg-white p-4 shadow sm:rounded-lg sm:p-6'>
                                Anda belum memiliki alamat pengiriman.
                            </div>
                        )}
                    </div>
                </div>
            </Container>
        </div>
    );
}

Index.layout = (page) => (
    <AppLayout
        header={<h2 className='text-xl font-semibold leading-tight text-gray-800'>Shipping Address</h2>}
        children={page}
    />
);
