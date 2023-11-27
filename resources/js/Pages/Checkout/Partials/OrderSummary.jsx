import { usePage } from '@inertiajs/react';
import { number_format } from '@/Libs/snippet.js';

export default function OrderSummary({ shipping = '-' }) {
    const { carts, order_summary } = usePage().props;
    let totalAfterCost =
        parseInt(order_summary.total?.replace(/\D/g, '')) + parseInt(shipping?.replace(/\D/g, '') || 0);
    return (
        <div className='mt-10 lg:mt-0'>
            <h2 className='text-lg font-medium text-slate-900'>Order summary</h2>

            <div className='mt-4 rounded-lg border border-slate-200 bg-white shadow-sm'>
                <h3 className='sr-only'>Items in your cart</h3>
                <ul role='list' className='divide-y divide-slate-200'>
                    {carts.map((cart) => (
                        <li key={cart.id} className='flex px-4 py-6 sm:px-6'>
                            <div className='flex-shrink-0'>
                                <img
                                    src={cart.variation.product.imageSrc}
                                    alt={cart.variation.product.imageAlt}
                                    className='w-20 rounded-md'
                                />
                            </div>

                            <div className='ml-6 flex flex-1 flex-col'>
                                <div className='flex'>
                                    <div className='min-w-0 flex-1'>
                                        <h4 className='text-sm'>
                                            <a
                                                href={cart.href}
                                                className='font-medium text-slate-700 hover:text-slate-800'>
                                                {cart.variation.product.name}
                                            </a>
                                        </h4>
                                        <p className='mt-1 flex items-center gap-x-2 text-sm text-slate-500'>
                                            <span>{cart.variation.attribute_1}</span>
                                            <span className='text-slate-300'>/</span>
                                            <span>{cart.variation.attribute_2}</span>
                                        </p>
                                    </div>
                                </div>

                                <div className='flex flex-1 items-end justify-between pt-2'>
                                    <p className='mt-1 text-sm font-medium text-slate-900'>Rp {cart.price}</p>
                                </div>
                            </div>
                            <div>
                                <p className='mt-1 text-sm font-medium text-slate-900'>{cart.quantity}x</p>
                            </div>
                        </li>
                    ))}
                </ul>
                <dl className='space-y-6 border-t border-slate-200 px-4 py-6 sm:px-6'>
                    <div className='flex items-center justify-between'>
                        <dt className='text-sm'>Subtotal</dt>
                        <dd className='text-sm font-medium text-slate-900'>Rp {order_summary.subtotal}</dd>
                    </div>
                    <div className='flex items-center justify-between'>
                        <dt className='text-sm'>Shipping</dt>
                        <dd className='text-sm font-medium text-slate-900'>Rp {shipping}</dd>
                    </div>
                    <div className='flex items-center justify-between'>
                        <dt className='text-sm'>PPN</dt>
                        <dd className='text-sm font-medium text-slate-900'>Rp {order_summary.tax}</dd>
                    </div>
                    <div className='flex items-center justify-between border-t border-slate-200 pt-6'>
                        <dt className='text-base font-medium'>Total</dt>
                        <dd className='text-base font-medium text-slate-900'>
                            Rp {number_format(totalAfterCost, 0, ',', '.')}
                        </dd>
                    </div>
                </dl>

                <div className='border-t border-slate-200 px-4 py-6 sm:px-6'>
                    <button
                        type='submit'
                        className='w-full rounded-md border border-transparent bg-blue-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-slate-50'>
                        Konfirmasi Pesanan
                    </button>
                </div>
            </div>
        </div>
    );
}
