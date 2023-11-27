import { Link, usePage } from '@inertiajs/react';
import { IconEditCircle } from '@tabler/icons-react';

export default function ContactInformation() {
    const { auth } = usePage().props;
    return (
        <>
            <h2 className='text-lg font-medium text-slate-900'>Detail Pembeli</h2>
            <div className='mt-4 bg-white p-4 rounded-lg shadow relative'>
                <Link
                    href={route('profile.edit')}
                    className='absolute right-0 top-0 mr-2 mt-2 rounded-full p-2 text-slate-500 hover:bg-slate-100 hover:text-blue-500'>
                    <IconEditCircle className='h-5 w-5 stroke-[1.25]' />
                </Link>
                <div>
                    <label htmlFor='email-address' className='block text-sm font-medium text-slate-700'>
                        Nama perima
                    </label>
                    <div>{auth.user.name}</div>
                </div>
                <div className='mt-4'>
                    <label htmlFor='email-address' className='block text-sm font-medium text-slate-700'>
                        Email address
                    </label>
                    <div>{auth.user.email}</div>
                </div>
            </div>
        </>
    );
}
