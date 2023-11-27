import { RadioGroup } from '@headlessui/react';
import clsx from 'clsx';
import { IconCircleCheckFilled } from '@tabler/icons-react';

export default function PaymentMethod({ selectedPaymentMethod, setSelectedPaymentMethod, paymentMethods }) {
    return (
        <div className='mt-10 border-t border-slate-200 pt-10'>
            <RadioGroup value={selectedPaymentMethod} onChange={setSelectedPaymentMethod}>
                <RadioGroup.Label className='text-lg font-medium text-gray-900'>Metode Pembayaran</RadioGroup.Label>

                <div className='mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4'>
                    {paymentMethods.map((paymentMethod) => (
                        <RadioGroup.Option
                            key={paymentMethod.id}
                            value={paymentMethod}
                            className={({ checked, active }) =>
                                clsx(
                                    checked ? 'border-transparent' : 'border-gray-300',
                                    active ? 'border-blue-500 ring ring-blue-100' : '',
                                    'relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none'
                                )
                            }>
                            {({ checked, active }) => (
                                <>
                                    <span className='flex flex-1'>
                                        <span className='flex flex-col'>
                                            <RadioGroup.Label
                                                as='span'
                                                className='block text-sm font-medium text-gray-900'>
                                                {paymentMethod.title}
                                            </RadioGroup.Label>
                                            <RadioGroup.Description
                                                as='span'
                                                className='mt-1 flex items-center text-sm text-gray-500'>
                                                {paymentMethod.method}
                                            </RadioGroup.Description>
                                            <RadioGroup.Description
                                                as='span'
                                                className='mt-6 text-sm font-medium text-gray-900'>
                                                {paymentMethod.description}
                                            </RadioGroup.Description>
                                        </span>
                                    </span>
                                    {checked ? (
                                        <IconCircleCheckFilled className='h-5 w-5 text-blue-600' aria-hidden='true' />
                                    ) : null}
                                    <span
                                        className={clsx(
                                            active ? 'border' : 'border-2',
                                            checked ? 'border-blue-500' : 'border-transparent',
                                            'pointer-events-none absolute -inset-px rounded-lg'
                                        )}
                                        aria-hidden='true'
                                    />
                                </>
                            )}
                        </RadioGroup.Option>
                    ))}
                </div>
            </RadioGroup>
        </div>
    );
}
